<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Moje konto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Zalogowano pomyślnie!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">{{ __('Historia zakupów') }}</h3>
                    @if(isset($purchaseHistory) && !$purchaseHistory->isEmpty())
                        <ul class="list-group">
                            @foreach($purchaseHistory as $purchase)
                                <li class="list-group-item d-flex align-items-center" style="padding: 20px;">
                                    <div class="d-flex flex-column ms-3" style="flex: 1;">
                                        <h5 class="fw-bold mb-1">{{ $purchase->course->title }}</h5>
                                        <p class="mb-0">{{ $purchase->created_at->format('d-m-Y H:i') }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-center">Nie masz jeszcze żadnych zakupów.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
