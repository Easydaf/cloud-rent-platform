<x-guest-layout>
    <div class="min-h-screen bg-midnight flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-off-white mb-2">{{ __('Create Account') }}</h1>
                <p class="text-soft-slate text-sm">{{ __('Join our cloud storage platform today') }}</p>
            </div>

            <!-- Card -->
            <div class="bg-soft-slate rounded-lg shadow-xl p-8">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Name')" class="text-off-white font-medium mb-2 block" />
                        <x-text-input
                            id="name"
                            class="block w-full px-4 py-2 bg-midnight text-off-white border border-gray-700 rounded-lg focus:outline-none focus:border-sunset focus:ring-2 focus:ring-sunset focus:ring-opacity-50 transition duration-200"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-coral text-xs" />
                    </div>

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
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-coral text-xs" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-8">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-off-white font-medium mb-2 block" />
                        <x-text-input
                            id="password_confirmation"
                            class="block w-full px-4 py-2 bg-midnight text-off-white border border-gray-700 rounded-lg focus:outline-none focus:border-sunset focus:ring-2 focus:ring-sunset focus:ring-opacity-50 transition duration-200"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-coral text-xs" />
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-4">
                        <x-primary-button class="w-full bg-sunset hover:bg-orange-500 text-midnight font-semibold py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sunset">
                            {{ __('Register') }}
                        </x-primary-button>

                        <div class="text-center">
                            <a class="text-peach hover:text-coral underline text-sm font-medium transition duration-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-peach" href="{{ route('login') }}">
                                {{ __('Already registered?') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer Info -->
            <div class="mt-8 text-center text-gray-500 text-xs">
                <p>{{ __('Your data is secure with us') }}</p>
            </div>
        </div>
    </div>
</x-guest-layout>