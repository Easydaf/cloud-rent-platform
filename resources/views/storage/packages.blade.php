<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cloud-dark leading-tight">
            {{ __('Pilih Paket Storage') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-cloud-bg min-h-screen text-cloud-dark">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-fade-in">
                <h1 class="text-4xl font-extrabold text-cloud-dark sm:text-5xl">Penyewaan Kapasitas Storage</h1>
                <p class="mt-4 text-xl text-cloud-slate">Pilih paket MiniStack IaaS yang sesuai dengan kebutuhan Anda.</p>
            </div>

            <!-- Banner Langganan Aktif Premium Orange Theme -->
            @if($activeSubscription)
                <div class="mb-12 p-6 bg-gradient-to-r from-orange-50 to-orange-100/30 border border-orange-100 rounded-2xl shadow-sm flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center mb-4 md:mb-0">
                        <div class="p-3 bg-cloud-orange rounded-xl text-white mr-6 shadow-md">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-cloud-dark">Layanan Penyimpanan Anda Aktif</h3>
                            <p class="text-sm text-cloud-slate">Anda saat ini terdaftar pada paket <span
                                    class="font-semibold text-cloud-orange">{{ $activeSubscription->package->package_name }}</span>
                                dengan kapasitas penyimpanan {{ $activeSubscription->storage_limit_gb }} GB.</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-cloud-orange mb-1">
                            Aktif
                        </span>
                        <p class="text-xs text-cloud-slate">Berakhir pada:
                            {{ $activeSubscription->expires_at->timezone('Asia/Jakarta')->format('d M Y') }}
                        </p>
                    </div>
                </div>
            @endif

            <!-- Pricing Grid Orange Theme -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

                @foreach($packages as $package)
                    @php
                        $isPro = $package->slug === 'pro';
                        $svgColor = 'text-cloud-orange';
                        
                        // Cek apakah paket ini adalah paket aktif saat ini
                        $isActivePlan = $activeSubscription && $activeSubscription->package_id === $package->id;
                    @endphp

                    <div
                        class="bg-cloud-card rounded-2xl flex flex-col justify-between overflow-hidden transition-all duration-300 {{ $isActivePlan ? 'border-2 border-cloud-orange ring-8 ring-cloud-orange/10 shadow-md transform scale-102' : 'border border-gray-200 shadow-sm hover:shadow-lg' }}">
                        <div class="p-8">
                            <div class="flex justify-between items-center">
                                <h3 class="text-2xl font-bold text-cloud-dark">{{ $package->package_name }}</h3>
                                @if($isActivePlan)
                                    <span
                                        class="px-3 py-1 text-xs font-semibold tracking-wider text-white uppercase bg-green-600 rounded-full shadow-sm">Aktif</span>
                                @elseif($isPro)
                                    <span
                                        class="px-3 py-1 text-xs font-semibold tracking-wider text-white uppercase bg-cloud-orange rounded-full">Populer</span>
                                @endif
                            </div>
                            <p class="mt-4 text-cloud-slate text-sm font-medium">{{ $package->description }}</p>
                            <p class="mt-8">
                                <span class="text-4xl font-extrabold text-cloud-dark">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                <span class="text-base font-medium text-cloud-slate">/bulan</span>
                            </p>
                            <ul class="mt-8 space-y-4">
                                <li class="flex items-center font-semibold text-sm">
                                    <svg class="h-6 w-6 {{ $svgColor }}" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="ml-3 text-cloud-slate">{{ $package->storage_limit_gb }} GB Storage</span>
                                </li>

                                @if($package->slug === 'enterprise')
                                    <li class="flex items-center font-semibold text-sm">
                                        <svg class="h-6 w-6 {{ $svgColor }}" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="ml-3 text-cloud-slate">Multiple MiniStack Buckets</span>
                                    </li>
                                    <li class="flex items-center font-semibold text-sm">
                                        <svg class="h-6 w-6 {{ $svgColor }}" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="ml-3 text-cloud-slate">24/7 Dedicated Support</span>
                                    </li>
                                @else
                                    <li class="flex items-center font-semibold text-sm">
                                        <svg class="h-6 w-6 {{ $svgColor }}" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span class="ml-3 text-cloud-slate">MiniStack Isolated Bucket</span>
                                    </li>
                                    <li class="flex items-center font-semibold text-sm">
                                        <svg class="h-6 w-6 {{ $svgColor }}" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span
                                            class="ml-3 text-cloud-slate">{{ $isPro ? 'Prioritas Support' : 'Standard Access Key' }}</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <div class="p-8 bg-cloud-bg border-t border-gray-100">
                            @if($isActivePlan)
                                <button disabled
                                    class="block text-center w-full bg-gray-100 text-gray-400 border border-gray-200 font-bold py-3 px-4 rounded-xl cursor-not-allowed">
                                    Paket Aktif Saat Ini
                                </button>
                            @else
                                <a href="{{ route('storage.confirm', ['slug' => $package->slug]) }}"
                                    class="block text-center w-full {{ $isPro ? 'bg-cloud-orange text-white hover:bg-orange-600 border-transparent shadow-md' : 'bg-white text-cloud-orange border border-cloud-orange hover:bg-orange-50' }} font-bold py-3 px-4 rounded-xl transition duration-200">
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