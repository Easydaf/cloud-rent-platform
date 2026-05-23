<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-cloud-dark leading-tight">
            {{ __('Riwayat Aktivitas & Log') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-cloud-bg min-h-screen text-cloud-dark animate-fade-in">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-md shadow-sm flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="h-6 w-6 text-green-500 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-semibold text-green-800">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="bg-cloud-card overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-cloud-dark mb-1 flex items-center gap-2">
                        <span class="w-2.5 h-2.5 bg-cloud-orange rounded-full animate-pulse shadow-sm"></span>
                        Aktivitas Terakhir Anda
                    </h3>
                    <p class="text-cloud-slate mb-6 text-sm font-medium">Riwayat riil log aktivitas Anda termasuk penyewaan storage dan log transaksi.</p>
                    
                    <!-- Search & Filter Form Premium Orange Theme -->
                    <form action="{{ route('logs.index') }}" method="GET" class="mb-8 bg-cloud-bg p-4 rounded-xl border border-gray-200/60 flex flex-col md:flex-row gap-4 items-end">
                        <div class="flex-1 w-full">
                            <label for="search" class="block text-xs font-bold text-cloud-slate uppercase mb-1.5 tracking-wider">Cari Aktivitas</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-cloud-slate" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </span>
                                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama aktivitas atau layanan..." class="pl-10 w-full text-sm border-gray-200 focus:border-cloud-orange focus:ring-cloud-orange rounded-lg shadow-sm">
                            </div>
                        </div>
                        
                        <div class="w-full md:w-48">
                            <label for="status" class="block text-xs font-bold text-cloud-slate uppercase mb-1.5 tracking-wider">Filter Status</label>
                            <select name="status" id="status" class="w-full text-sm border-gray-200 focus:border-cloud-orange focus:ring-cloud-orange rounded-lg shadow-sm">
                                <option value="">Semua Status</option>
                                <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>Sukses</option>
                                <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Gagal</option>
                            </select>
                        </div>
                        
                        <div class="flex gap-2 w-full md:w-auto">
                            <button type="submit" class="flex-1 md:flex-initial px-5 py-2.5 bg-cloud-orange hover:bg-orange-600 text-white text-sm font-bold rounded-lg shadow-sm transition duration-150 whitespace-nowrap transform hover:scale-102">
                                Terapkan
                            </button>
                            @if(request()->filled('search') || request()->filled('status'))
                                <a href="{{ route('logs.index') }}" class="flex-1 md:flex-initial px-5 py-2.5 bg-white hover:bg-gray-50 border border-gray-200 text-cloud-slate text-sm font-bold rounded-lg shadow-sm text-center transition duration-150">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </form>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-cloud-bg text-cloud-slate">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider rounded-l-lg">
                                        Tanggal & Waktu
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
                                        Aktivitas
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider rounded-r-lg">
                                        IP Address
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 font-semibold text-cloud-slate">
                                @forelse($logs as $log)
                                    <tr class="hover:bg-cloud-bg/50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-cloud-slate font-medium">
                                            {{ $log->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-cloud-dark">{{ $log->action }}</div>
                                            <div class="text-xs text-cloud-slate mt-0.5 font-medium">
                                                Layanan: <span class="font-bold text-cloud-orange">{{ $log->service }}</span> | Tipe: {{ $log->resource_type ?? '-' }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($log->status === 'success')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-green-100 text-green-700 border border-green-200">
                                                    Sukses
                                                </span>
                                            @elseif($log->status === 'failed')
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-red-100 text-red-700 border border-red-200">
                                                    Gagal
                                                </span>
                                            @else
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-yellow-100 text-yellow-700 border border-yellow-200">
                                                    {{ ucfirst($log->status) }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-cloud-slate font-mono">
                                            {{ $log->ip_address ?? '127.0.0.1' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-12 text-center text-cloud-slate text-sm">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="font-bold text-cloud-dark">Tidak ada riwayat aktivitas ditemukan</span>
                                                <span class="text-xs text-cloud-slate mt-1 font-medium">Coba sesuaikan kata kunci pencarian atau filter status Anda.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination Links -->
                    <div class="mt-6 border-t border-gray-100 pt-4">
                        {{ $logs->links() }}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
