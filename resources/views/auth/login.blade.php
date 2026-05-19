<x-guest-layout>
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
        
        <div class="hidden lg:flex flex-col justify-between p-12 bg-[#F97316] text-[#F9FAFB]">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#F9FAFB] rounded-lg flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-[#111827]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                    </svg>
                </div>
                <span class="text-2xl font-bold tracking-wider text-[#F9FAFB]">CloudRent</span>
            </div>
            
            <div class="max-w-md">
                <h2 class="text-4xl font-extrabold mb-4 leading-tight">
                    Platform Penyewaan Cloud Storage Instan & Aman.
                </h2>
                <p class="text-gray-300 text-lg">
                    Akses infrastruktur cloud terisolasi Anda secara instan, pantau resource, dan amankan kredensial Anda dalam satu dasbor terintegrasi.
                </p>
            </div>

            <div class="text-xs text-gray-500">
                &copy; {{ date('Y') }} CloudRent Platform. All rights reserved.
            </div>
        </div>

        <div class="flex items-center justify-center p-8 sm:p-12 md:p-16 bg-[#F9FAFB]">
            <div class="w-full max-w-md">
                
                <div class="lg:hidden text-center mb-8">
                    <div class="w-12 h-12 bg-[#F97316] rounded-lg flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <svg class="w-7 h-7 text-[#111827]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                    </div>
                    <h1 class="text-3xl font-bold text-[#111827] mb-2">CloudRent</h1>
                </div>

                <div class="mb-10 text-center lg:text-left">
                    <h1 class="text-3xl font-extrabold text-[#111827] mb-2">{{ __('Welcome Back') }}</h1>
                    <p class="text-[#1F2937] text-sm">{{ __('Log in to your cloud storage account') }}</p>
                </div>

                <x-auth-session-status class="mb-6 bg-[#F97316] bg-opacity-10 border border-[#F97316] rounded-lg p-3 text-[#F97316] text-sm" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" class="text-[#111827] font-medium mb-2 block" />
                        <x-text-input id="email" class="block w-full px-4 py-2.5 bg-white text-[#111827] border border-gray-300 rounded-lg focus:outline-none focus:border-[#F97316] focus:ring-2 focus:ring-[#F97316] focus:ring-opacity-50 transition duration-200" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#FB7185] text-xs" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" class="text-[#111827] font-medium mb-2 block" />
                        <x-text-input id="password" class="block w-full px-4 py-2.5 bg-white text-[#111827] border border-gray-300 rounded-lg focus:outline-none focus:border-[#F97316] focus:ring-2 focus:ring-[#F97316] focus:ring-opacity-50 transition duration-200" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#FB7185] text-xs" />
                    </div>

                    <div class="flex items-center justify-between mb-8">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input id="remember_me" type="checkbox" class="w-4 h-4 rounded bg-white border-gray-300 border text-[#F97316] focus:ring-2 focus:ring-[#F97316] focus:ring-offset-0 transition duration-200" name="remember">
                            <span class="ms-2 text-sm text-[#1F2937] group-hover:text-[#F97316] transition duration-200">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-[#FDBA74] hover:text-[#F97316] underline text-sm font-medium transition duration-200" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="flex flex-col gap-4">
                        <x-primary-button class="w-full bg-[#F97316] hover:bg-orange-500 text-[#F9FAFB] font-bold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-[1.02] justify-center shadow-[0_4px_10px_rgba(249,115,22,0.3)]">
                            {{ __('Log in') }}
                        </x-primary-button>

                        <p class="text-center text-sm text-[#1F2937] mt-2">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="text-[#F97316] hover:underline font-medium ml-1">Daftar sekarang</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>