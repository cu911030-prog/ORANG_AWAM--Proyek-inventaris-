<x-guest-layout>
    <div class="mb-6 text-center">
        <a href="/" class="mx-auto inline-flex items-center justify-center rounded-3xl bg-slate-950 px-5 py-4 text-white shadow-lg shadow-slate-200/20 hover:bg-slate-800">
            <x-application-logo class="w-12 h-12 text-white" />
            <span class="ms-3 text-left">
                <span class="block text-base font-semibold">Sistem Inventaris Barang</span>
                <span class="block text-xs text-slate-200">Login untuk melanjutkan</span>
            </span>
        </a>
    </div>

    <div class="mb-6 rounded-3xl bg-slate-950 p-5 text-white shadow-xl">
        <h2 class="text-2xl font-semibold">Selamat Datang Kembali</h2>
        <p class="mt-2 text-sm text-slate-300">Masuk dengan kredensial Anda untuk mengelola inventaris barang.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
