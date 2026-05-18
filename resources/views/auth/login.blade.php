<x-guest-layout>
    <div class="min-h-screen bg-midnight flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-off-white mb-2">{{ __('Welcome Back') }}</h1>
                <p class="text-soft-slate text-sm">{{ __('Log in to your cloud storage account') }}</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-6 bg-sunset bg-opacity-10 border border-sunset rounded-lg p-3 text-peach text-sm" :status="session('status')" />

            <!-- Card -->
            <div class="bg-soft-slate rounded-lg shadow-xl p-8">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" class="text-off-white font-medium mb-2 block" />
                        <x-text-input
                            id="email"
                            class="block w-full px-4 py-2 bg-midnight text-off-white border border-gray-700 rounded-lg focus:outline-none focus:border-sunset focus:ring-2 focus:ring-sunset focus:ring-opacity-50 transition duration-200"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-coral text-xs" />
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <x-input-label for="password" :value="__('Password')" class="text-off-white font-medium mb-2 block" />
                        <x-text-input
                            id="password"
                            class="block w-full px-4 py-2 bg-midnight text-off-white border border-gray-700 rounded-lg focus:outline-none focus:border-sunset focus:ring-2 focus:ring-sunset focus:ring-opacity-50 transition duration-200"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-coral text-xs" />
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-8">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                            <input
                                id="remember_me"
                                type="checkbox"
                                class="w-4 h-4 rounded bg-midnight border-sunset border-2 text-sunset focus:ring-2 focus:ring-sunset focus:ring-offset-0 transition duration-200"
                                name="remember">
                            <span class="ms-2 text-sm text-off-white group-hover:text-peach transition duration-200">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-4">
                        <x-primary-button class="w-full bg-sunset hover:bg-orange-500 text-midnight font-semibold py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sunset">
                            {{ __('Log in') }}
                        </x-primary-button>

                        @if (Route::has('password.request'))
                        <div class="text-center">
                            <a class="text-peach hover:text-coral underline text-sm font-medium transition duration-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-peach" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Footer Info -->
            <div class="mt-8 text-center text-gray-500 text-xs">
                <p>{{ __('Secure login with end-to-end encryption') }}</p>
            </div>
        </div>
    </div>
</x-guest-layout>