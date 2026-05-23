<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Penyewaan') }}
        </h2>
    </x-slot>

    <!-- Loading Overlay Premium -->
    <div id="loadingOverlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-2xl shadow-xl flex flex-col items-center max-w-sm mx-4 text-center">
            <!-- Spinner -->
            <svg class="animate-spin h-12 w-12 text-blue-600 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <h3 class="text-lg font-bold text-gray-900 mb-2">Memproses Pemesanan</h3>
            <p class="text-sm text-gray-500">Mohon tunggu sebentar, sistem sedang mengalokasikan isolated S3 bucket dan menerbitkan kredensial MiniStack untuk Anda...</p>
        </div>
    </div>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <svg class="mx-auto h-12 w-12 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                        <h2 class="mt-4 text-2xl font-bold text-gray-900">Ringkasan Pesanan Anda</h2>
                        <p class="text-gray-500 mt-2">Mohon periksa kembali detail layanan MiniStack IaaS yang Anda sewa.</p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Paket Langganan</h3>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-gray-600">Nama Paket</span>
                            <span class="font-bold text-gray-900 text-lg">{{ $package->package_name }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-gray-600">Kapasitas Penyimpanan</span>
                            <span class="font-medium text-gray-900">{{ $package->storage_limit_gb }} GB</span>
                        </div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-gray-600">Deskripsi Layanan</span>
                            <span class="font-medium text-gray-900 text-right w-1/2">{{ $package->description }}</span>
                        </div>
                        <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200">
                            <span class="font-bold text-gray-800">Total Pembayaran</span>
                            <span class="text-2xl font-extrabold text-blue-600">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <form id="checkoutForm" action="{{ route('storage.purchase') }}" method="POST">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-end">
                            <a href="{{ route('storage.packages') }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Kembali
                            </a>
                            <button type="submit" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Konfirmasi & Proses
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to Trigger Spinner on Submit -->
    <script>
        document.getElementById('checkoutForm').addEventListener('submit', function() {
            // Tampilkan loading overlay premium
            document.getElementById('loadingOverlay').classList.remove('hidden');
        });
    </script>
</x-app-layout>
