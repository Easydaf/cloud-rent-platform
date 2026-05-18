<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CloudRent - Sewa Cloud Storage Instan & Aman</title>

    @fonts

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <style>
        /*! tailwindcss v4 */
        @import url('https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
        }

        .text-off-white {
            color: #F9FAFB;
        }

        .bg-midnight {
            background-color: #111827;
        }

        .bg-soft-slate {
            background-color: #1F2937;
        }

        .bg-sunset {
            background-color: #F97316;
        }

        .text-sunset {
            color: #F97316;
        }

        .text-peach {
            color: #FDBA74;
        }

        .border-sunset {
            border-color: #F97316;
        }

        .border-peach {
            border-color: #FDBA74;
        }

        .hover\:bg-orange-500:hover {
            background-color: #f59e0b;
        }

        .transition {
            transition: all 0.3s ease;
        }

        .transform:hover {
            transform: scale(1.05);
        }
    </style>
    @endif
</head>

<body class="bg-midnight min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-2xl">
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-sunset rounded-lg mb-6">
                <svg class="w-8 h-8 text-midnight" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-off-white mb-4">CloudRent</h1>
            <p class="text-gray-400 text-sm md:text-base">Platform penyewaan cloud storage terpercaya</p>
        </div>

        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-off-white mb-4 leading-tight">
                Sewa Cloud Storage<br />Instan & Aman
            </h2>
            <p class="text-gray-400 text-base md:text-lg max-w-xl mx-auto">
                Nikmati penyimpanan cloud yang cepat, aman, dan terjangkau. Mulai dari kapasitas kecil hingga enterprise, kami siap melayani kebutuhan Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-12">
            <div class="bg-soft-slate rounded-lg p-4 border border-gray-700">
                <div class="flex items-center justify-center w-10 h-10 bg-sunset bg-opacity-20 rounded-lg mb-3">
                    <svg class="w-5 h-5 text-sunset" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-off-white font-semibold text-sm mb-1">Sangat Cepat</h3>
                <p class="text-gray-400 text-xs">Upload & download dengan kecepatan maksimal</p>
            </div>

            <div class="bg-soft-slate rounded-lg p-4 border border-gray-700">
                <div class="flex items-center justify-center w-10 h-10 bg-peach bg-opacity-20 rounded-lg mb-3">
                    <svg class="w-5 h-5 text-peach" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-off-white font-semibold text-sm mb-1">Aman & Terenkripsi</h3>
                <p class="text-gray-400 text-xs">Data Anda dilindungi dengan enkripsi tingkat enterprise</p>
            </div>

            <div class="bg-soft-slate rounded-lg p-4 border border-gray-700">
                <div class="flex items-center justify-center w-10 h-10 bg-coral bg-opacity-20 rounded-lg mb-3">
                    <svg class="w-5 h-5 text-coral" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-off-white font-semibold text-sm mb-1">Harga Terjangkau</h3>
                <p class="text-gray-400 text-xs">Paket fleksibel sesuai budget dan kebutuhan</p>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}"
               class="inline-block bg-sunset hover:bg-orange-500 text-midnight font-semibold py-3 px-8 rounded-lg transition duration-200 transform hover:scale-105 text-center">
                {{ __('Mulai Menyewa') }}
            </a>

            <a href="{{ route('login') }}"
               class="inline-block border-2 border-peach text-peach hover:bg-peach hover:text-midnight font-semibold py-3 px-8 rounded-lg transition duration-200 transform hover:scale-105 text-center">
                {{ __('Masuk Akun') }}
            </a>
        </div>

        <div class="mt-16 pt-8 border-t border-gray-700 text-center">
            <p class="text-gray-500 text-xs mb-4">{{ __('Dipercaya oleh ribuan pengguna di seluruh Indonesia') }}</p>
            <div class="flex items-center justify-center gap-6 text-gray-400 text-xs">
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4 text-sunset" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <span>4.9/5 Rating</span>
                </div>
                <div>{{ __('100% Uptime SLA') }}</div>
                <div>{{ __('24/7 Support') }}</div>
            </div>
        </div>
    </div>
</body>

</html>