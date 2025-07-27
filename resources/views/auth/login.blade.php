{{-- resources/views/auth/login.blade.php --}}
<x-layout title="Login">
    <x-slot name="heading">Sign In</x-slot>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex items-center justify-center px-4 py-24">
        <div class="max-w-md w-full bg-white dark:bg-gray-800 rounded-2xl shadow p-8">
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                {{-- Email --}}
                <div>
                    <x-form-label for="email">Email Address</x-form-label>
                    <x-form-input
                        id="email"
                        name="email"
                        type="email"
                        :value="old('email')"
                        placeholder="you@example.com"
                        required
                        autofocus
                    />
                    @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Password --}}
                <div>
                    <x-form-label for="password">Password</x-form-label>
                    <x-form-input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="••••••••"
                        required
                    />
                    @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center">
                    <input
                        id="remember"
                        name="remember"
                        type="checkbox"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    />
                    <label for="remember" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                        Remember me
                    </label>
                </div>

                {{-- Submit --}}
                <div class="pt-4">
                    <x-button variant="primary" type="submit" class="w-full">
                        Log in
                    </x-button>
                </div>

                <div class="text-center text-sm text-gray-600 dark:text-gray-400">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
