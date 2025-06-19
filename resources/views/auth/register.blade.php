<x-guest-layout>
    <!-- Full Background Logo -->
    <div class="absolute top-0 left-0 w-full h-full bg-cover bg-center z-[-1]" style="background-image: url('/lagaw-icon.png');"></div>

    <form method="POST" action="{{ route('register') }}" class="bg-gradient-to-r from-teal-400 via-blue-500 to-purple-600 rounded-lg shadow-lg p-8 animate-slideIn relative z-10">
        @csrf

        <div class="text-center mb-6">
            <img src="{{ asset('lagaw-icon.png') }}" alt="Lagaw Logo" class="mx-auto mb-4 w-24 h-24 rounded-full shadow-lg border-4 border-white" />
            <h1 class="text-4xl font-bold text-white mb-2">Register to Lagaw!</h1>
            <p class="text-sm text-gray-100">Create your account below</p>
        </div>

        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" class="text-white" />
            <x-text-input id="name" class="block mt-1 w-full px-4 py-2 rounded-lg border border-teal-500 focus:ring-2 focus:ring-teal-300 text-black" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-white" />
            <x-text-input id="email" class="block mt-1 w-full px-4 py-2 rounded-lg border border-teal-500 focus:ring-2 focus:ring-teal-300 text-black" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Contact Number -->
        <div class="mb-4">
            <x-input-label for="contact_number" :value="__('Contact Number')" class="text-white" />
            <x-text-input id="contact_number" class="block mt-1 w-full px-4 py-2 rounded-lg border border-teal-500 focus:ring-2 focus:ring-teal-300 text-black" type="text" name="contact_number" :value="old('contact_number')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('contact_number')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" class="text-white" />
            <x-text-input id="password" class="block mt-1 w-full px-4 py-2 rounded-lg border border-teal-500 focus:ring-2 focus:ring-teal-300 text-black" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-white" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full px-4 py-2 rounded-lg border border-teal-500 focus:ring-2 focus:ring-teal-300 text-black" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-teal-100 hover:text-teal-200 underline" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="bg-teal-500 hover:bg-teal-600 focus:bg-teal-700 text-white w-full py-2 rounded-md transition duration-300 ease-in-out">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <!-- Social Login with Teal Theme -->
        <div class="text-center mt-6">
            <p class="text-sm text-white mb-2">Or sign in with</p>
            <a href="{{ route('auth.google') }}" class="inline-flex items-center justify-center px-4 py-2 bg-teal-50 border border-teal-200 rounded-md font-semibold text-xs text-teal-800 uppercase tracking-widest hover:bg-teal-100 focus:bg-teal-100 active:bg-teal-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Sign in with Google
            </a>
        </div>
    </form>
</x-guest-layout>
