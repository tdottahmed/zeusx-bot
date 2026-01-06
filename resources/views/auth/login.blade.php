<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium leading-6 text-gray-300">Email Address</label>
            <div class="mt-2">
                <input id="email" name="email" type="email" autocomplete="email" required autofocus 
                    class="block w-full rounded-md border-0 py-2.5 text-white bg-gray-800 shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-zeus-vibrant sm:text-sm sm:leading-6"
                    value="{{ old('email') }}">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium leading-6 text-gray-300">Password</label>
                @if (Route::has('password.request'))
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-semibold text-zeus-vibrant hover:text-zeus-pink transition-colors">Forgot password?</a>
                    </div>
                @endif
            </div>
            <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="current-password" required 
                    class="block w-full rounded-md border-0 py-2.5 text-white bg-gray-800 shadow-sm ring-1 ring-inset ring-gray-700 placeholder:text-gray-500 focus:ring-2 focus:ring-inset focus:ring-zeus-vibrant sm:text-sm sm:leading-6">
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-600 bg-gray-700 text-zeus-vibrant focus:ring-zeus-vibrant focus:ring-offset-gray-900">
                <label for="remember_me" class="ml-3 block text-sm leading-6 text-gray-300">Remember me</label>
            </div>
        </div>

        <div>
            <button type="submit" class="flex w-full justify-center rounded-md bg-zeus-deep px-3 py-2.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-zeus-vibrant focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zeus-vibrant transition-all duration-200">
                Sign in to Dashboard
            </button>
        </div>
    </form>
    
    <div class="mt-6 text-center text-sm">
        <span class="text-gray-500">Don't have an account?</span>
        <a href="{{ route('register') }}" class="font-semibold text-zeus-pink hover:text-zeus-deep ml-1">Register now</a>
    </div>
</x-guest-layout>
