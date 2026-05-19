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
                    Mulai Konfigurasi Virtual Storage Anda Hari Ini.
                </h2>
                <p class="text-gray-200 text-lg leading-relaxed">
                    Dapatkan ruang penyimpanan terisolasi yang terhubung ke simulator MiniStack lokal lengkap dengan manajemen hak akses IAM otomatis.
                </p>
            </div>

            <div class="text-xs text-orange-200 opacity-80">
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
                    <h1 class="text-3xl font-extrabold text-[#111827] mb-2">{{ __('Create Account') }}</h1>
                    <p class="text-[#1F2937] text-sm">{{ __('Join our cloud storage platform today') }}</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Name')" class="text-[#111827] font-medium mb-2 block" />
                        <x-text-input id="name" class="block w-full px-4 py-2.5 bg-white text-[#111827] border border-gray-300 rounded-lg focus:outline-none focus:border-[#F97316] focus:ring-2 focus:ring-[#F97316] focus:ring-opacity-50 transition duration-200" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-[#FB7185] text-xs" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" class="text-[#111827] font-medium mb-2 block" />
                        <x-text-input id="email" class="block w-full px-4 py-2.5 bg-white text-[#111827] border border-gray-300 rounded-lg focus:outline-none focus:border-[#F97316] focus:ring-2 focus:ring-[#F97316] focus:ring-opacity-50 transition duration-200" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-[#FB7185] text-xs" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" class="text-[#111827] font-medium mb-2 block" />
                        <x-text-input id="password" class="block w-full px-4 py-2.5 bg-white text-[#111827] border border-gray-300 rounded-lg focus:outline-none focus:border-[#F97316] focus:ring-2 focus:ring-[#F97316] focus:ring-opacity-50 transition duration-200" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-[#FB7185] text-xs" />
                    </div>

                    <div class="mb-8">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-[#111827] font-medium mb-2 block" />
                        <x-text-input id="password_confirmation" class="block w-full px-4 py-2.5 bg-white text-[#111827] border border-gray-300 rounded-lg focus:outline-none focus:border-[#F97316] focus:ring-2 focus:ring-[#F97316] focus:ring-opacity-50 transition duration-200" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-[#FB7185] text-xs" />
                    </div>

                    <div class="flex flex-col gap-4">
                        <x-primary-button class="w-full bg-[#F97316] hover:bg-orange-500 text-[#F9FAFB] font-bold py-3 px-4 rounded-lg transition duration-200 transform hover:scale-[1.02] justify-center shadow-[0_4px_10px_rgba(249,115,22,0.3)]">
                            {{ __('Register') }}
                        </x-primary-button>

                        <p class="text-center text-sm text-[#1F2937] mt-2">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" class="text-[#F97316] hover:underline font-medium ml-1">Masuk di sini</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>