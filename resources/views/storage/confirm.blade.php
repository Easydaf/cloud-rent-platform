<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cloud-dark leading-tight">
            {{ __('Konfirmasi Penyewaan') }}
        </h2>
    </x-slot>

    <!-- Loading Overlay Premium Orange Theme -->
    <div id="loadingOverlay" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-2xl shadow-xl flex flex-col items-center max-w-sm mx-4 text-center">
            <!-- Spinner -->
            <svg class="animate-spin h-12 w-12 text-cloud-orange mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <h3 class="text-lg font-bold text-cloud-dark mb-2">Memproses Pemesanan</h3>
            <p class="text-sm text-cloud-slate font-medium">Mohon tunggu sebentar, sistem sedang mengalokasikan isolated S3 bucket dan menerbitkan kredensial MiniStack untuk Anda...</p>
        </div>
    </div>

    <div class="py-12 bg-cloud-bg min-h-screen text-cloud-dark animate-fade-in">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-cloud-card overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <svg class="mx-auto h-12 w-12 text-cloud-orange animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                        <h2 class="mt-4 text-2xl font-bold text-cloud-dark">Ringkasan Pesanan Anda</h2>
                        <p class="text-cloud-slate mt-2 text-sm font-medium">Mohon periksa kembali detail layanan MiniStack IaaS yang Anda sewa.</p>
                    </div>

                    <div class="bg-cloud-bg rounded-xl p-6 border border-gray-200 mb-8 font-semibold">
                        <h3 class="text-lg font-black text-cloud-dark mb-4 border-b pb-2">Paket Langganan</h3>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-cloud-slate">Nama Paket</span>
                            <span class="font-extrabold text-cloud-dark text-lg">{{ $package->package_name }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-cloud-slate">Kapasitas Penyimpanan</span>
                            <span class="font-bold text-cloud-dark">{{ $package->storage_limit_gb }} GB</span>
                        </div>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-cloud-slate">Deskripsi Layanan</span>
                            <span class="font-medium text-cloud-slate text-right w-1/2">{{ $package->description }}</span>
                        </div>
                        <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200">
                            <span class="font-black text-cloud-dark">Total Pembayaran</span>
                            <span class="text-2xl font-extrabold text-cloud-orange">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <form id="checkoutForm" action="{{ route('storage.purchase') }}" method="POST">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $package->id }}">
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-end">
                            <a href="{{ route('storage.packages') }}" class="inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-bold rounded-md text-cloud-slate bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cloud-orange">
                                Kembali
                            </a>
                            <button type="submit" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-bold rounded-md text-white bg-cloud-orange hover:bg-orange-600 shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cloud-orange transition duration-150 transform hover:scale-102">
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
