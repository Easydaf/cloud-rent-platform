<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::create([
            'package_name' => 'Basic',
            'slug' => 'basic',
            'storage_limit_gb' => 10,
            'bandwidth_limit_gb' => 50,
            'max_objects' => 1000,
            'price' => 50000.00,
            'description' => 'Sempurna untuk personal dan tugas kuliah.',
            'is_active' => true,
        ]);

        Package::create([
            'package_name' => 'Pro',
            'slug' => 'pro',
            'storage_limit_gb' => 50,
            'bandwidth_limit_gb' => 250,
            'max_objects' => 10000,
            'price' => 150000.00,
            'description' => 'Ideal untuk tim dan developer profesional.',
            'is_active' => true,
        ]);

        Package::create([
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
}
