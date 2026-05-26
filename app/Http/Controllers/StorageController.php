<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\UserSubscription;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
// Import SDK AWS resmi untuk PHP
use Aws\S3\S3Client;
use Aws\Iam\IamClient;

class StorageController extends Controller
{
    /**
     * Tampilkan halaman dashboard utama secara real-time.
     */
    public function dashboard()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // 1. Ambil data sewa storage yang sedang aktif saat ini
        $activeSubscription = $user->subscriptions()
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->orderBy('created_at', 'desc')
            ->first();
            
        // 2. Ambil 5 log aktivitas terbaru khusus untuk user ini
        $recentLogs = ActivityLog::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        return view('dashboard', compact('activeSubscription', 'recentLogs'));
    }

    /**
     * Tampilkan halaman daftar paket storage.
     */
    public function packages()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $packages = Package::where('is_active', true)->get();
        $activeSubscription = $user->subscriptions()
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->orderBy('created_at', 'desc')
            ->first();
            
        return view('storage.packages', compact('packages', 'activeSubscription'));
    }

    /**
     * Tampilkan halaman konfirmasi pembayaran / sewa.
     */
    public function confirm(string $slug)
    {
        $package = Package::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('storage.confirm', compact('package'));
    }

    /**
     * Proses penyewaan storage (Subscribe) & Auto-create Resources di MiniStack.
     */
    public function purchase(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $package = Package::findOrFail($request->package_id);

        // 1. Buat record transaksi sewa baru di database lokal
        $subscription = UserSubscription::create([
            'user_id' => $user->id,
            'package_id' => $package->id,
            'status' => 'active',
            'price_paid' => $package->price,
            'storage_limit_gb' => $package->storage_limit_gb,
            'storage_used_gb' => 0,
            'started_at' => now(),
            'expires_at' => now()->addDays(30),
        ]);

        $miniStackStatus = 'success';
        $errorMessage = null;

        // 2. INTEGRASI MINISTACK REAL (S3 & IAM API)
        if (!$user->bucket_name) {
            $usernameSlug = Str::slug(strtolower($user->name));
            $bucketName = 'bucket-' . $usernameSlug;

            // Menggunakan IP 127.0.0.1 untuk mencegah isu pembelokan IPv6 oleh localhost di Windows
            $endpoint = env('AWS_ENDPOINT', 'http://127.0.0.1:4566');

            try {
                $iamClient = new IamClient([
                    'version'     => 'latest',
                    'region'      => 'us-east-1',
                    'endpoint'    => $endpoint,
                    'credentials' => ['key' => 'test', 'secret' => 'test'],
                ]);

                // Proteksi User: Abaikan error jika entitas user sudah ada di MiniStack Docker
                try {
                    $iamClient->createUser(['UserName' => $usernameSlug]);
                } catch (\Exception $iamError) {
                    if (!str_contains($iamError->getMessage(), 'EntityAlreadyExists')) {
                        throw $iamError;
                    }
                }

                // Generate Access Key & Secret Key dari MiniStack
                $keyResponse = $iamClient->createAccessKey(['UserName' => $usernameSlug]);
                $accessKey   = $keyResponse['AccessKey']['AccessKeyId'];
                $secretKey   = $keyResponse['AccessKey']['SecretAccessKey'];

                $s3Client = new S3Client([
                    'version'                 => 'latest',
                    'region'                  => 'us-east-1',
                    'endpoint'                => $endpoint,
                    'use_path_style_endpoint' => true,
                    'credentials'             => ['key' => 'test', 'secret' => 'test'],
                ]);

                // Proteksi Bucket: Abaikan error jika bucket sudah dibuat sebelumnya di Docker
                try {
                    $s3Client->createBucket(['Bucket' => $bucketName]);
                } catch (\Exception $s3Error) {
                    if (!str_contains($s3Error->getMessage(), 'BucketAlreadyExists') && !str_contains($s3Error->getMessage(), 'BucketAlreadyOwnedByYou')) {
                        throw $s3Error;
                    }
                }

                // Berhasil terhubung! Simpan kredensial nyata MiniStack ke database user
                $user->update([
                    'bucket_name'           => $bucketName,
                    'aws_access_key_id'     => $accessKey,
                    'aws_secret_access_key' => $secretKey,
                ]);

            } catch (\Exception $e) {
                $miniStackStatus = 'failed';
                $errorMessage = $e->getMessage();
                Log::error('Gagal koneksi ke MiniStack Docker: ' . $errorMessage);
            }
        }

        // 3. Catat aktivitas final ke dalam log sistem
        ActivityLog::create([
            'user_id'         => $user->id,
            'subscription_id' => $subscription->id,
            'service'         => 'Storage',
            'action'          => 'Subscribe ' . $package->package_name . ($miniStackStatus === 'failed' ? ' (MiniStack Error)' : ''),
            'resource_type'   => 'Subscription',
            'resource_id'     => $subscription->id,
            'payload'         => [
                'package_name'     => $package->package_name,
                'price_paid'       => $package->price,
                'storage_limit_gb' => $package->storage_limit_gb,
                'error_message'    => $errorMessage
            ],
            'ip_address'      => $request->ip(),
            'user_agent'      => $request->userAgent(),
            'status'          => $miniStackStatus,
        ]);

        if ($miniStackStatus === 'failed') {
            return redirect()->route('dashboard')->with('error', 'Sewa berhasil di DB lokal, tetapi gagal membuat container MiniStack. Alasan: ' . $errorMessage);
        }

        return redirect()->route('dashboard')->with('success', 'Penyewaan paket ' . $package->package_name . ' berhasil diproses dan bucket MiniStack berhasil dibuat!');
    }

    /**
     * Tampilkan riwayat aktivitas / logs.
     */
    public function logs(Request $request)
    {
        $query = ActivityLog::where('user_id', Auth::id());

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('action', 'like', '%' . $search . '%')
                  ->orWhere('service', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $logs = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('logs.index', compact('logs'));
    }
}