<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pilih Paket Storage') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl">Penyewaan Kapasitas Storage</h1>
                <p class="mt-4 text-xl text-gray-500">Pilih paket MiniStack IaaS yang sesuai dengan kebutuhan Anda.</p>
            </div>

            <!-- Banner Langganan Aktif -->
            @if($activeSubscription)
                <div class="mb-12 p-6 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-100 rounded-2xl shadow-sm flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center mb-4 md:mb-0">
                        <div class="p-3 bg-blue-600 rounded-xl text-white mr-4 shadow-md">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Layanan Penyimpanan Anda Aktif</h3>
                            <p class="text-sm text-gray-600">Anda saat ini terdaftar pada paket <span class="font-semibold text-blue-600">{{ $activeSubscription->package->package_name }}</span> dengan kapasitas penyimpanan {{ $activeSubscription->storage_limit_gb }} GB.</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 mb-1">
                            Aktif
                        </span>
                        <p class="text-xs text-gray-500">Berakhir pada: {{ $activeSubscription->expires_at->timezone('Asia/Jakarta')->format('d M Y') }}</p>
                    </div>
                </div>
            @endif

            <!-- Pricing Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

                @foreach($packages as $package)
                    @php
                        $isPro = $package->slug === 'pro';
                        $svgColor = $isPro ? 'text-blue-500' : 'text-green-500';
                        
                        // Cek apakah paket ini adalah paket aktif saat ini
                        $isActivePlan = $activeSubscription && $activeSubscription->package_id === $package->id;
                    @endphp
                    
                    <div class="bg-white rounded-2xl flex flex-col justify-between overflow-hidden transition-all duration-300 {{ $isActivePlan ? 'border-2 border-blue-500 ring-8 ring-blue-500/10 shadow-md transform scale-102' : 'border border-gray-200 shadow-sm hover:shadow-lg' }}">
                        <div class="p-8">
                            <div class="flex justify-between items-center">
                                <h3 class="text-2xl font-bold text-gray-900">{{ $package->package_name }}</h3>
                                @if($isActivePlan)
                                    <span class="px-3 py-1 text-xs font-semibold tracking-wider text-white uppercase bg-green-600 rounded-full shadow-sm">Aktif</span>
                                @elseif($isPro)
                                    <span class="px-3 py-1 text-xs font-semibold tracking-wider text-white uppercase bg-blue-600 rounded-full">Populer</span>
                                @endif
                            </div>
                            <p class="mt-4 text-gray-500 text-sm">{{ $package->description }}</p>
                            <p class="mt-8">
                                <span class="text-4xl font-extrabold text-gray-900">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                <span class="text-base font-medium text-gray-500">/bulan</span>
                            </p>
                            <ul class="mt-8 space-y-4">
                                <li class="flex items-center">
                                    <svg class="h-6 w-6 {{ $svgColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="ml-3 text-gray-700">{{ $package->storage_limit_gb }} GB Storage</span>
                                </li>
                                
                                @if($package->slug === 'enterprise')
                                    <li class="flex items-center">
                                        <svg class="h-6 w-6 {{ $svgColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="ml-3 text-gray-700">Multiple MiniStack Buckets</span>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-6 w-6 {{ $svgColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="ml-3 text-gray-700">24/7 Dedicated Support</span>
                                    </li>
                                @else
                                    <li class="flex items-center">
                                        <svg class="h-6 w-6 {{ $svgColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="ml-3 text-gray-700">MiniStack Isolated Bucket</span>
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-6 w-6 {{ $svgColor }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="ml-3 text-gray-700">{{ $isPro ? 'Prioritas Support' : 'Standard Access Key' }}</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="p-8 bg-gray-50 border-t border-gray-100">
                            @if($isActivePlan)
                                <button disabled
                                    class="block text-center w-full bg-gray-100 text-gray-400 border border-gray-200 font-bold py-3 px-4 rounded-xl cursor-not-allowed">
                                    Paket Aktif Saat Ini
                                </button>
                            @else
                                <a href="{{ route('storage.confirm', ['slug' => $package->slug]) }}"
                                    class="block text-center w-full bg-white text-blue-600 border border-blue-600 hover:bg-blue-50 font-bold py-3 px-4 rounded-xl transition duration-200 {{ $isPro ? 'shadow-md' : '' }}">
                                    Pilih Paket {{ $package->package_name }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>