<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StorageFrontendTest extends TestCase
{
    use RefreshDatabase;

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
     * Test halaman log aktivitas bisa diakses.
     */
    public function test_user_can_view_activity_logs()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/logs');

        $response->assertStatus(200);
        $response->assertSee('Aktivitas Terakhir Anda');
        $response->assertSee('Tanggal');
    }
}
