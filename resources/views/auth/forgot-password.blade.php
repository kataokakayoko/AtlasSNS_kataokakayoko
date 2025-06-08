<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your mail address and we will mail you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.mail') }}">
        @csrf

        <!-- mail Address -->
        <div>
            <x-input-label for="mail" :value="__('mail')" />
            <x-text-input id="mail" class="block mt-1 w-full" type="mail" name="mail" :value="old('mail')" required autofocus />
            <x-input-error :messages="$errors->get('mail')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('mail Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
