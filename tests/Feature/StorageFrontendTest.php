<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Package;
use App\Models\UserSubscription;
use App\Models\ActivityLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorageFrontendTest extends TestCase
{
    use RefreshDatabase;

    private $basicPackage;
    private $proPackage;
    private $enterprisePackage;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat paket-paket dummy di database untuk keperluan testing
        $this->basicPackage = Package::create([
            'package_name' => 'Basic',
            'slug' => 'basic',
            'storage_limit_gb' => 10,
            'bandwidth_limit_gb' => 50,
            'max_objects' => 1000,
            'price' => 50000.00,
            'description' => 'Sempurna untuk personal dan tugas kuliah.',
            'is_active' => true,
        ]);

        $this->proPackage = Package::create([
            'package_name' => 'Pro',
            'slug' => 'pro',
            'storage_limit_gb' => 50,
            'bandwidth_limit_gb' => 250,
            'max_objects' => 10000,
            'price' => 150000.00,
            'description' => 'Ideal untuk tim dan developer profesional.',
            'is_active' => true,
        ]);

        $this->enterprisePackage = Package::create([
            'package_name' => 'Enterprise',
            'slug' => 'enterprise',
            'storage_limit_gb' => 500,
            'bandwidth_limit_gb' => 1000,
            'max_objects' => 100000,
            'price' => 500000.00,
            'description' => 'Skalabilitas penuh untuk proyek besar.',
            'is_active' => true,
        ]);
    }

    /**
     * Test jika user yang belum login di-redirect ke halaman login
     * saat mencoba mengakses halaman sewa paket.
     */
    public function test_guest_is_redirected_to_login()
    {
        $response = $this->get('/storage/packages');
        $response->assertRedirect('/login');
    }

    /**
     * Test halaman pilih paket bisa diakses oleh user yang login.
     */
    public function test_authenticated_user_can_view_packages()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/storage/packages');

        $response->assertStatus(200);
        $response->assertSee('Penyewaan Kapasitas Storage');
        $response->assertSee('Basic');
        $response->assertSee('Pro');
        $response->assertSee('Enterprise');
        $response->assertSee('Rp 50.000');
        $response->assertSee('Rp 150.000');
        $response->assertSee('Rp 500.000');
    }

    /**
     * Test halaman konfirmasi paket bisa dibuka sesuai dengan paket yang dipilih.
     */
    public function test_user_can_view_confirmation_page_for_pro_plan()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/storage/confirm/pro');

        $response->assertStatus(200);
        $response->assertSee('Ringkasan Pesanan Anda');
        $response->assertSee('Pro');
        $response->assertSee('Rp 150.000');
        $response->assertSee('50 GB');
    }

    /**
     * Test proses sewa paket (checkout) berhasil membuat data di DB,
     * membuat bucket, dan mencatat log aktivitas.
     */
    public function test_user_can_purchase_plan_successfully()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/storage/purchase', [
            'package_id' => $this->proPackage->id,
        ]);

        // Verifikasi redirect ke halaman log
        $response->assertRedirect('/logs');
        $response->assertSessionHas('success');

        // Verifikasi UserSubscription ada di database
        $this->assertDatabaseHas('user_subscriptions', [
            'user_id' => $user->id,
            'package_id' => $this->proPackage->id,
            'status' => 'active',
            'price_paid' => 150000.00,
        ]);

        // Verifikasi bucket & key AWS digenerate di tabel users
        $updatedUser = $user->fresh();
        $this->assertNotNull($updatedUser->bucket_name);
        $this->assertNotNull($updatedUser->aws_access_key_id);
        $this->assertNotNull($updatedUser->aws_secret_access_key);

        // Verifikasi log aktivitas tercatat di database
        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'service' => 'Storage',
            'action' => 'Subscribe Pro',
            'status' => 'success',
        ]);
    }

    /**
     * Test halaman log aktivitas menampilkan log asli dari database.
     */
    public function test_user_can_view_activity_logs()
    {
        $user = User::factory()->create();

        // Buat log palsu di database
        ActivityLog::create([
            'user_id' => $user->id,
            'service' => 'Storage',
            'action' => 'Subscribe Pro',
            'ip_address' => '127.0.0.1',
            'status' => 'success',
        ]);

        $response = $this->actingAs($user)->get('/logs');

        $response->assertStatus(200);
        $response->assertSee('Aktivitas Terakhir Anda');
        $response->assertSee('Subscribe Pro');
        $response->assertSee('Sukses');
    }
}
