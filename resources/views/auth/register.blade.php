{{-- resources/views/auth/register.blade.php --}}
<x-layout title="Register">
  <x-slot name="heading">Create an Account</x-slot>

  <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full bg-white dark:bg-gray-800 rounded-2xl shadow p-8">
      <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        {{-- First Name --}}
        <div>
          <x-form-label for="first_name">First Name</x-form-label>
          <x-form-input
            id="first_name"
            name="first_name"
            type="text"
            :value="old('first_name')"
            placeholder="e.g. Bushra"
            required
            autofocus
          />
          @error('first_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Last Name --}}
        <div>
          <x-form-label for="last_name">Last Name</x-form-label>
          <x-form-input
            id="last_name"
            name="last_name"
            type="text"
            :value="old('last_name')"
            placeholder="e.g. Al Arishi"
            required
          />
          @error('last_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Username --}}
        <div>
          <x-form-label for="username">Username</x-form-label>
          <x-form-input
            id="username"
            name="username"
            type="text"
            :value="old('username')"
            placeholder="e.g. bushra123"
            required
          />
          @error('username') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

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

        {{-- Confirm Password --}}
        <div>
          <x-form-label for="password_confirmation">Confirm Password</x-form-label>
          <x-form-input
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            placeholder="••••••••"
            required
          />
        </div>

        {{-- Submit --}}
        <div class="pt-4">
          <x-button variant="primary" type="submit" class="w-full">
            Register
          </x-button>
        </div>

        <div class="text-center text-sm text-gray-600 dark:text-gray-400">
          Already have an account?
          <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Log in</a>
        </div>
      </form>
    </div>
  </div>
</x-layout>
