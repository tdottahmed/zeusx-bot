<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium leading-6 text-gray-300">Full Name</label>
            <div class="mt-2">
                <input id="name" name="name" type="text" autocomplete="name" required autofocus 
                    class="block w-full rounded-md border-0 py-2.5 text-white bg-gray-800 shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-zeus-vibrant sm:text-sm sm:leading-6"
                    value="{{ old('name') }}">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-300">Email Address</label>
            <div class="mt-2">
                <input id="email" name="email" type="email" autocomplete="email" required 
                    class="block w-full rounded-md border-0 py-2.5 text-white bg-gray-800 shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-zeus-vibrant sm:text-sm sm:leading-6"
                    value="{{ old('email') }}">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium leading-6 text-gray-300">Password</label>
            <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="new-password" required 
                    class="block w-full rounded-md border-0 py-2.5 text-white bg-gray-800 shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-zeus-vibrant sm:text-sm sm:leading-6">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-300">Confirm Password</label>
            <div class="mt-2">
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                   class="block w-full rounded-md border-0 py-2.5 text-white bg-gray-800 shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-zeus-vibrant sm:text-sm sm:leading-6">
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-zeus-deep px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-zeus-vibrant focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zeus-vibrant transition-all duration-200">
                Create Account
            </button>
        </div>
    </form>

    <div class="mt-6 text-center text-sm">
        <span class="text-gray-500">Already have an account?</span>
        <a href="{{ route('login') }}" class="font-semibold text-zeus-pink hover:text-zeus-deep ml-1">Log in</a>
    </div>
</x-guest-layout>
