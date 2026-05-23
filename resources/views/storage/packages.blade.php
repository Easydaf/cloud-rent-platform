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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-20">

                <!-- Tier 1: Basic -->
                <div
                    class="bg-white border border-gray-200 rounded-2xl shadow-sm flex flex-col justify-between overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900">Basic</h3>
                        <p class="mt-4 text-gray-500 text-sm">Sempurna untuk personal dan tugas kuliah.</p>
                        <p class="mt-8">
                            <span class="text-4xl font-extrabold text-gray-900">Rp 50.000</span>
                            <span class="text-base font-medium text-gray-500">/bulan</span>
                        </p>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3 text-gray-700">10 GB Storage</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3 text-gray-700">MiniStack Isolated Bucket</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3 text-gray-700">Standard Access Key</span>
                            </li>
                        </ul>
                    </div>
                    <div class="p-8 bg-gray-50 border-t border-gray-100">
                        <a href="{{ route('storage.confirm', ['plan' => 'basic']) }}"
                            class="block text-center w-full bg-white text-blue-600 border border-blue-600 hover:bg-blue-50 font-bold py-3 px-4 rounded-xl transition duration-200">
                            Pilih Paket Basic
                        </a>
                    </div>
                </div>

                <!-- Tier 2: Pro (Populer) -->
                <div
                    class="bg-white border border-gray-200 rounded-2xl shadow-sm flex flex-col justify-between overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-8">
                        <div class="flex justify-between items-center">
                            <h3 class="text-2xl font-bold text-gray-900">Pro</h3>
                            <span
                                class="px-3 py-1 text-xs font-semibold tracking-wider text-white uppercase bg-blue-600 rounded-full">Populer</span>
                        </div>
                        <p class="mt-4 text-gray-500 text-sm">Ideal untuk tim dan developer profesional.</p>
                        <p class="mt-8">
                            <span class="text-4xl font-extrabold text-gray-900">Rp 150.000</span>
                            <span class="text-base font-medium text-gray-500">/bulan</span>
                        </p>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3 text-gray-700">50 GB Storage</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3 text-gray-700">MiniStack Isolated Bucket</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3 text-gray-700">Prioritas Support</span>
                            </li>
                        </ul>
                    </div>
                    <div class="p-8 bg-gray-50 border-t border-gray-100">
                        <a href="{{ route('storage.confirm', ['plan' => 'pro']) }}"
                            class="block text-center w-full bg-white text-blue-600 border border-blue-600 hover:bg-blue-50 font-bold py-3 px-4 rounded-xl transition duration-200 shadow-md">
                            Pilih Paket Pro
                        </a>
                    </div>
                </div>

                <!-- Tier 3: Enterprise -->
                <div
                    class="bg-white border border-gray-200 rounded-2xl shadow-sm flex flex-col justify-between overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900">Enterprise</h3>
                        <p class="mt-4 text-gray-500 text-sm">Skalabilitas penuh untuk proyek besar.</p>
                        <p class="mt-8">
                            <span class="text-4xl font-extrabold text-gray-900">Rp 500.000</span>
                            <span class="text-base font-medium text-gray-500">/bulan</span>
                        </p>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3 text-gray-700">500 GB Storage</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3 text-gray-700">Multiple MiniStack Buckets</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="ml-3 text-gray-700">24/7 Dedicated Support</span>
                            </li>
                        </ul>
                    </div>
                    <div class="p-8 bg-gray-50 border-t border-gray-100">
                        <a href="{{ route('storage.confirm', ['plan' => 'enterprise']) }}"
                            class="block text-center w-full bg-white text-blue-600 border border-blue-600 hover:bg-blue-50 font-bold py-3 px-4 rounded-xl transition duration-200">
                            Pilih Paket Enterprise
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>