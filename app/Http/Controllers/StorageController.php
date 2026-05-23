<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\UserSubscription;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StorageController extends Controller
{
    /**
     * Tampilkan halaman daftar paket storage.
     */
    public function packages()
    {
        $packages = Package::where('is_active', true)->get();
        $activeSubscription = Auth::user()->subscriptions()
            ->where('status', 'active')
            ->where('expires_at', '>', now())
            ->orderBy('created_at', 'desc')
            ->first();
            
        return view('storage.packages', compact('packages', 'activeSubscription'));
    }

    /**
     * Tampilkan halaman konfirmasi pembayaran / sewa.
     */
    public function confirm($slug)
    {
        $package = Package::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('storage.confirm', compact('package'));
    }

    /**
     * Proses penyewaan storage (Subscribe).
     */
    public function purchase(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
        ]);

        $user = Auth::user();
        $package = Package::findOrFail($request->package_id);

        // 1. Buat subscription baru di database
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

        // 2. Simulasi auto-create isolated S3 bucket untuk user (jika belum ada)
        // Ini membantu integrasi dengan Iki (S3 SDK) dan Hikmah (Dashboard Kredensial)
        if (!$user->bucket_name) {
            $user->update([
                'bucket_name' => 'ministack-bucket-' . Str::slug($user->name) . '-' . rand(1000, 9999),
                'aws_access_key_id' => 'MSAK' . Str::upper(Str::random(16)),
                'aws_secret_access_key' => Str::random(40),
            ]);
        }

        // 3. Catat aktivitas di tabel activity_logs
        ActivityLog::create([
            'user_id' => $user->id,
            'subscription_id' => $subscription->id,
            'service' => 'Storage',
            'action' => 'Subscribe ' . $package->package_name,
            'resource_type' => 'Subscription',
            'resource_id' => $subscription->id,
            'payload' => [
                'package_name' => $package->package_name,
                'price_paid' => $package->price,
                'storage_limit_gb' => $package->storage_limit_gb,
            ],
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'status' => 'success',
        ]);

        return redirect()->route('logs.index')->with('success', 'Penyewaan paket ' . $package->package_name . ' berhasil diproses!');
    }

    /**
     * Tampilkan riwayat aktivitas / logs.
     */
    public function logs(Request $request)
    {
        $query = ActivityLog::where('user_id', Auth::id());

        // Filter berdasarkan pencarian kata kunci (action atau service)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('action', 'like', '%' . $search . '%')
                  ->orWhere('service', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan status (success / failed)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $logs = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('logs.index', compact('logs'));
    }
}
