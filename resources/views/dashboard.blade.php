<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-off-white leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <p class="text-soft-slate text-sm">{{ __('Welcome back!') }}</p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-midnight py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                <!-- Card: Sisa Kuota Penyewaan -->
                <div class="bg-soft-slate rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:scale-105">
                    <div class="p-6">
                        <!-- Header dengan Icon -->
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-off-white">{{ __('Storage Quota') }}</h3>
                            <div class="bg-sunset bg-opacity-20 rounded-full p-3">
                                <svg class="w-6 h-6 text-sunset" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Main Content -->
                        <div class="mb-6">
                            <p class="text-4xl font-bold text-sunset mb-2">750 <span class="text-lg text-off-white ml-1">GB</span></p>
                            <p class="text-sm text-gray-400">{{ __('of 1 TB used') }}</p>
                        </div>

                        <!-- Progress Bar -->
                        <div class="w-full bg-midnight rounded-full h-3 overflow-hidden">
                            <div class="bg-gradient-to-r from-sunset to-peach h-full rounded-full" style="width: 75%;"></div>
                        </div>

                        <!-- Footer Info -->
                        <div class="mt-4 pt-4 border-t border-gray-700">
                            <p class="text-xs text-gray-400">{{ __('Upgrade to unlock more storage') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card: Paket Aktif -->
                <div class="bg-soft-slate rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:scale-105">
                    <div class="p-6">
                        <!-- Header dengan Icon -->
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-off-white">{{ __('Active Package') }}</h3>
                            <div class="bg-peach bg-opacity-20 rounded-full p-3">
                                <svg class="w-6 h-6 text-peach" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Main Content -->
                        <div class="mb-6">
                            <p class="text-3xl font-bold text-peach mb-2">Professional</p>
                            <p class="text-sm text-gray-400">{{ __('Premium plan') }}</p>
                        </div>

                        <!-- Plan Details -->
                        <div class="space-y-2 pb-4 border-b border-gray-700">
                            <div class="flex items-center text-sm text-off-white">
                                <svg class="w-4 h-4 mr-2 text-sunset" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                {{ __('1 TB Storage') }}
                            </div>
                            <div class="flex items-center text-sm text-off-white">
                                <svg class="w-4 h-4 mr-2 text-sunset" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                {{ __('Priority Support') }}
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="mt-4">
                            <p class="text-xs text-gray-400">{{ __('Renews on May 18, 2027') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Card: Kredensial Akses -->
                <div class="bg-soft-slate rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:scale-105">
                    <div class="p-6">
                        <!-- Header dengan Icon -->
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-off-white">{{ __('Access Credentials') }}</h3>
                            <div class="bg-coral bg-opacity-20 rounded-full p-3">
                                <svg class="w-6 h-6 text-coral" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Credentials Content -->
                        <div class="space-y-4">
                            <!-- Access Key -->
                            <div>
                                <label class="text-xs font-semibold text-off-white block mb-2">{{ __('Access Key') }}</label>
                                <div class="flex items-center gap-2">
                                    <input type="password" value="AKIAIOSFODNN7EXAMPLE" readonly class="flex-1 bg-midnight text-off-white text-sm px-3 py-2 rounded border border-gray-700 focus:outline-none" id="access-key">
                                    <button onclick="toggleVisibility('access-key')" class="bg-sunset hover:bg-orange-500 text-midnight text-xs font-semibold px-3 py-2 rounded transition duration-200">
                                        {{ __('Show') }}
                                    </button>
                                </div>
                            </div>

                            <!-- Secret Key -->
                            <div>
                                <label class="text-xs font-semibold text-off-white block mb-2">{{ __('Secret Key') }}</label>
                                <div class="flex items-center gap-2">
                                    <input type="password" value="wJalrXUtnFEMI/K7MDENG/bPxRfiCYEXAMPLEKEY" readonly class="flex-1 bg-midnight text-off-white text-sm px-3 py-2 rounded border border-gray-700 focus:outline-none" id="secret-key">
                                    <button onclick="toggleVisibility('secret-key')" class="bg-sunset hover:bg-orange-500 text-midnight text-xs font-semibold px-3 py-2 rounded transition duration-200">
                                        {{ __('Show') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Warning -->
                        <div class="mt-4 pt-4 border-t border-gray-700">
                            <p class="text-xs text-coral flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ __('Keep these credentials secure') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info Section -->
            <div class="bg-soft-slate rounded-xl shadow-lg p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-off-white mb-4">{{ __('Recent Activity') }}</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between pb-3 border-b border-gray-700">
                        <div>
                            <p class="text-off-white text-sm font-medium">{{ __('File uploaded: project-documentation.pdf') }}</p>
                            <p class="text-gray-400 text-xs">{{ __('Today at 2:30 PM') }}</p>
                        </div>
                        <span class="text-peach text-xs font-semibold">{{ __('2.4 MB') }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b border-gray-700">
                        <div>
                            <p class="text-off-white text-sm font-medium">{{ __('Shared folder with team') }}</p>
                            <p class="text-gray-400 text-xs">{{ __('Yesterday at 10:15 AM') }}</p>
                        </div>
                        <span class="text-sunset text-xs font-semibold">{{ __('5 members') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-off-white text-sm font-medium">{{ __('Storage backup completed') }}</p>
                            <p class="text-gray-400 text-xs">{{ __('3 days ago') }}</p>
                        </div>
                        <span class="text-coral text-xs font-semibold">{{ __('Auto') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleVisibility(elementId) {
            const input = document.getElementById(elementId);
            const button = event.target;

            if (input.type === 'password') {
                input.type = 'text';
                button.textContent = '{{ __("Hide") }}';
                button.classList.add('bg-coral', 'hover:bg-red-600');
                button.classList.remove('bg-sunset', 'hover:bg-orange-500');
            } else {
                input.type = 'password';
                button.textContent = '{{ __("Show") }}';
                button.classList.remove('bg-coral', 'hover:bg-red-600');
                button.classList.add('bg-sunset', 'hover:bg-orange-500');
            }
        }
    </script>
</x-app-layout>