<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="mt-4">
                <x-label for="surname" :value="__('Surname')" />

                <x-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required
                         autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="mt-4">
                <x-label for="EMBG" :value="__('EMBG')" />

                <x-input id="EMBG" class="block mt-1 w-full" type="text" name="EMBG" :value="old('EMBG')" required  />
            </div>

            <div class="mt-4">
                <x-label for="phone_number" :value="__('Phone')" />

                <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required  />
            </div>

            <div class="mt-4">
                <x-label for="city" :value="__('City')" />

                <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')
                " required  />
            </div>

            <div class="mt-4">
                <x-label for="street" :value="__('Street')" />

                <x-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old
                ('street')" required  />
            </div>

            <div class="mt-4">
                <x-label for="date_of_birth" :value="__('Date of Birth')" />

                <x-input id="date_of_birth" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old
                ('date_of_birth')" required  />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
