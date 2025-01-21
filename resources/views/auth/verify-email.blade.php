<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Dziękujemy za rejestrację! Przed rozpoczęciem, czy możesz zweryfikować swój adres e-mail, klikając na link, który właśnie wysłaliśmy na Twój adres e-mail? Jeśli nie otrzymałeś e-maila, chętnie wyślemy Ci kolejny.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Nowy link weryfikacyjny został wysłany na adres e-mail podany podczas rejestracji.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Wyślij ponownie e-mail weryfikacyjny') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Wyloguj') }}
            </button>
        </form>
    </div>
</x-guest-layout>
