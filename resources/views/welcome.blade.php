<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CloudRent - Sewa Cloud Storage Instan & Aman</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-cloud-bg text-cloud-dark min-h-screen flex items-center justify-center px-4 py-12 antialiased">
    <div class="w-full max-w-2xl">
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-cloud-orange text-white rounded-2xl mb-6 shadow-md">
                <svg class="w-9 h-9" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                </svg>
            </div>
            <h1 class="text-4xl font-black text-cloud-dark tracking-tight mb-2">CloudRent</h1>
            <p class="text-cloud-slate text-sm font-medium">Platform Penyewaan Cloud Storage Terpercaya</p>
        </div>

        <div class="text-center mb-12">
            <h2 class="text-4xl font-extrabold text-cloud-dark mb-4 leading-tight">
                Sewa Cloud Storage<br /><span class="text-cloud-orange">Instan & Aman</span>
            </h2>
            <p class="text-cloud-slate text-base max-w-lg mx-auto leading-relaxed">
                Nikmati penyimpanan cloud yang cepat, aman, dan fleksibel. Mulai dari kapasitas kecil hingga skala enterprise dengan kemudahan manajemen akses lokal.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">
            <div class="bg-cloud-card border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-center justify-center w-10 h-10 bg-cloud-orange bg-opacity-10 text-cloud-orange rounded-lg mb-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-cloud-dark font-bold text-sm mb-1">Sangat Cepat</h3>
                <p class="text-cloud-slate text-xs leading-relaxed">Proses transmisi data upload & download dengan kecepatan maksimal.</p>
            </div>

            <div class="bg-cloud-card border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-center justify-center w-10 h-10 bg-cloud-orange bg-opacity-10 text-cloud-orange rounded-lg mb-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-cloud-dark font-bold text-sm mb-1">Isolated Bucket</h3>
                <p class="text-cloud-slate text-xs leading-relaxed">Setiap pendaftaran otomatis memicu pembuatan container terisolasi.</p>
            </div>

            <div class="bg-cloud-card border border-gray-200 rounded-xl p-5 shadow-sm">
                <div class="flex items-center justify-center w-10 h-10 bg-cloud-orange bg-opacity-10 text-cloud-orange rounded-lg mb-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-cloud-dark font-bold text-sm mb-1">Tarif Fleksibel</h3>
                <p class="text-cloud-slate text-xs leading-relaxed">Skema pembayaran transparan yang disesuaikan dengan kuota kebutuhan.</p>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}"
               class="inline-block bg-cloud-orange hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-lg transition duration-200 transform hover:scale-105 text-center shadow-md">
                Mulai Menyewa
            </a>

            <a href="{{ route('login') }}"
               class="inline-block border-2 border-cloud-orange text-cloud-orange hover:bg-cloud-orange hover:text-white font-bold py-3 px-8 rounded-lg transition duration-200 transform hover:scale-105 text-center">
                Masuk Akun
            </a>
        </div>
    </div>
</body>

</html>