<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

         <!-- C&F Name -->
         <div class="mt-4">
            <x-input-label for="cnf_name" :value="__('C&F Name')" />
            <x-text-input id="cnf_name" class="block mt-1 w-full" type="text" name="cnf_name" :value="old('cnf_name')" required autocomplete="cnf_name" />
            <x-input-error :messages="$errors->get('cnf_name')" class="mt-2" />
        </div>

         <!-- AIN Number -->
         <div class="mt-4">
            <x-input-label for="ain_no" :value="__('AIN Number')" />
            <x-text-input id="ain_no" class="block mt-1 w-full" type="text" name="ain_no" :value="old('ain_no')" required autocomplete="ain_no" />
            <x-input-error :messages="$errors->get('ain_no')" class="mt-2" />
        </div>

         <!-- Phone Number -->
         <div class="mt-4">
            <x-input-label for="contact_no" :value="__('Phone/Mobile Number')" />
            <x-text-input id="contact_no" class="block mt-1 w-full" type="text" name="contact_no" :value="old('contact_no')" required autocomplete="contact_no" />
            <x-input-error :messages="$errors->get('contact_no')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
