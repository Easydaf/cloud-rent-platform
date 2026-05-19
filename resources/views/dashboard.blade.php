<x-app-layout>
    <div class="min-h-screen bg-cloud-bg text-cloud-dark py-12 px-4 sm:px-6 lg:px-8 animate-fade-in">
        <div class="max-w-7xl mx-auto">
            
            <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-gray-200 pb-6">
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-cloud-dark">
                        Selamat Datang, <span class="text-cloud-orange">{{ Auth::user()->name }}</span>!
                    </h1>
                    <p class="text-cloud-slate mt-1 text-sm font-medium">Pantau resource dan konfigurasi penyimpanan cloud terisolasi Anda.</p>
                </div>
                <div>
                    <a href="#" class="inline-flex items-center px-5 py-2.5 bg-cloud-orange hover:bg-orange-600 text-white font-bold rounded-lg transition duration-200 transform hover:scale-105 shadow-md text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Sewa Storage Baru
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-cloud-card border border-gray-200 rounded-xl p-6 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-cloud-slate font-bold text-xs uppercase tracking-wider">Sisa Kuota Storage</h3>
                            <span class="p-2 bg-cloud-orange bg-opacity-10 text-cloud-orange rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.58 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.58 4 8 4s8-1.79 8-4M4 7c0-2.21 3.58-4 8-4s8 1.79 8 4m0 5c0 2.21-3.58 4-8 4s8-1.79 8-4"/>
                                </svg>
                            </span>
                        </div>
                        <div class="mb-4">
                            <span class="text-4xl font-black text-cloud-dark">35.2</span>
                            <span class="text-cloud-slate text-lg font-bold"> / 100 GB used</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 mb-2">
                            <div class="bg-cloud-orange h-2.5 rounded-full" style="width: 35%"></div>
                        </div>
                    </div>
                    <div class="text-xs text-cloud-orange font-semibold flex items-center gap-1 mt-4">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"/>
                        </svg>
                        Tersisa sekitar 64.8 GB ruang kosong
                    </div>
                </div>

                <div class="bg-cloud-card border border-gray-200 rounded-xl p-6 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-cloud-slate font-bold text-xs uppercase tracking-wider">Paket Langganan Aktif</h3>
                            <span class="p-2 bg-cloud-peach bg-opacity-20 text-cloud-orange rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </span>
                        </div>
                        <div class="mb-2">
                            <span class="text-lg font-extrabold text-cloud-dark bg-cloud-bg px-3 py-1 rounded-md border border-gray-200">Pro Developer Tier</span>
                        </div>
                        <p class="text-cloud-slate text-xs mt-3 leading-relaxed font-medium">
                            Masa aktif hingga: <span class="text-cloud-coral font-bold">16 Juni 2026</span><br>
                            Fitur mencakup isolated bucket otomatis, akses API MiniStack, dan enkripsi end-to-end.
                        </p>
                    </div>
                    <div class="text-xs text-gray-400 mt-4 font-semibold">
                        ID Sewa: #SR-202605-0982
                    </div>
                </div>

                <div x-data = "{ showKeys: false }" class="bg-cloud-card border border-gray-200 rounded-xl p-6 shadow-sm flex flex-col justify-between lg:col-span-1 md:col-span-2">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-cloud-slate font-bold text-xs uppercase tracking-wider">Kredensial Akses MiniStack</h3>
                            <button @click="showKeys = !showKeys" class="text-xs bg-cloud-bg hover:bg-gray-200 text-cloud-orange font-bold px-3 py-1.5 rounded-md border border-gray-300 transition duration-150">
                                <span x-text="showKeys ? 'Hide Keys' : 'Show Keys'"></span>
                            </button>
                        </div>
                        
                        <div class="mb-4">
                            <label class="text-gray-400 text-xs font-bold block mb-1">AWS_ACCESS_KEY_ID</label>
                            <div class="bg-cloud-bg px-3 py-2 rounded-lg font-mono text-sm border border-gray-200 select-all tracking-wide text-cloud-dark">
                                <span x-show="showKeys">AKIAIOSFODNN7EXAMPLE</span>
                                <span x-show="!showKeys" class="text-gray-400">••••••••••••••••••••</span>
                            </div>
                        </div>

                        <div>
                            <label class="text-gray-400 text-xs font-bold block mb-1">AWS_SECRET_ACCESS_KEY</label>
                            <div class="bg-cloud-bg px-3 py-2 rounded-lg font-mono text-sm border border-gray-200 select-all tracking-wide text-cloud-dark">
                                <span x-show="showKeys" class="text-cloud-orange font-semibold">wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY</span>
                                <span x-show="!showKeys" class="text-gray-400">••••••••••••••••••••••••••••••••••••••••</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-[11px] text-cloud-slate font-medium flex items-center gap-1 mt-4">
                        <svg class="w-3.5 h-3.5 text-cloud-coral" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                        </svg>
                        Keamanan tingkat tinggi. Jangan bagikan Secret Key ini.
                    </div>
                </div>

            </div>

            <div class="bg-cloud-card border border-gray-200 rounded-xl p-6 shadow-sm">
                <h3 class="text-lg font-black text-cloud-dark mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 bg-cloud-orange rounded-full animate-pulse shadow-sm"></span>
                    Log Aktivitas Penyewaan Terbaru
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-cloud-slate">
                        <thead class="text-xs uppercase bg-cloud-bg text-cloud-slate border-b border-gray-200">
                            <tr>
                                <th class="p-4 rounded-l-lg">Aktivitas</th>
                                <th class="p-4">Layanan MiniStack</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 rounded-r-lg">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 font-semibold">
                            <tr class="hover:bg-cloud-bg hover:bg-opacity-50 transition">
                                <td class="p-4 text-cloud-dark">Auto-create isolated bucket <code class="bg-cloud-bg px-1.5 py-0.5 rounded text-cloud-orange text-xs">cloudrent-user-{{ Auth::user()->id }}</code></td>
                                <td class="p-4 font-mono text-xs text-cloud-orange">AWS S3</td>
                                <td class="p-4"><span class="px-2.5 py-0.5 bg-green-100 text-green-700 rounded-full text-xs font-bold">Success</span></td>
                                <td class="p-4 text-gray-400 font-medium">Baru saja (Saat Registrasi)</td>
                            </tr>
                            <tr class="hover:bg-cloud-bg hover:bg-opacity-50 transition">
                                <td class="p-4 text-cloud-dark">Inisialisasi Akses Kredensial Pengguna Baru</td>
                                <td class="p-4 font-mono text-xs text-cloud-orange">AWS IAM</td>
                                <td class="p-4"><span class="px-2.5 py-0.5 bg-green-100 text-green-700 rounded-full text-xs font-bold">Success</span></td>
                                <td class="p-4 text-gray-400 font-medium">Baru saja (Saat Registrasi)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>