<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-semibold text-[#4A4A4A]">Buat Akun Baru</h2>
        <p class="text-gray-600 mt-2">Daftar untuk mengakses sistem</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-6">
            <label for="name" class="block text-sm font-medium text-[#4A4A4A]">Nama Lengkap</label>
            <div class="mt-1">
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#009A44] focus:border-transparent">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
        </div>

        <!-- Email Address -->
        <div class="mb-6">
            <label for="email" class="block text-sm font-medium text-[#4A4A4A]">Email</label>
            <div class="mt-1">
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#009A44] focus:border-transparent">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>

        <!-- Password -->
        <div class="mb-6">
            <label for="password" class="block text-sm font-medium text-[#4A4A4A]">Password</label>
            <div class="mt-1">
                <input id="password" type="password" name="password" required
                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#009A44] focus:border-transparent">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-[#4A4A4A]">Konfirmasi Password</label>
            <div class="mt-1">
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#009A44] focus:border-transparent">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <button type="submit"
            class="w-full py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#009A44] hover:bg-[#008038] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#009A44] transition-colors">
            Daftar
        </button>

        <p class="mt-6 text-center text-sm text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-medium text-[#00A3AF] hover:text-[#009A44] transition-colors">
                Masuk disini
            </a>
        </p>
    </form>
</x-guest-layout>
