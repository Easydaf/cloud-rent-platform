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

            <!-- Pricing Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

                @foreach($packages as $package)
                    @php
                        $isPro = $package->slug === 'pro';
                        $svgColor = $isPro ? 'text-blue-500' : 'text-green-500';
                    @endphp
                    
                    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm flex flex-col justify-between overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="p-8">
                            <div class="flex justify-between items-center">
                                <h3 class="text-2xl font-bold text-gray-900">{{ $package->package_name }}</h3>
                                @if($isPro)
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
                            <a href="{{ route('storage.confirm', ['slug' => $package->slug]) }}"
                                class="block text-center w-full bg-white text-blue-600 border border-blue-600 hover:bg-blue-50 font-bold py-3 px-4 rounded-xl transition duration-200 {{ $isPro ? 'shadow-md' : '' }}">
                                Pilih Paket {{ $package->package_name }}
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>