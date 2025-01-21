<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historia zakupów') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($purchaseHistory->isEmpty())
                        <p class="text-center">Nie masz jeszcze żadnych zakupów.</p>
                    @else
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">{{ __('Kurs') }}</th>
                                    <th class="px-4 py-2 text-left">{{ __('Data') }}</th>
                                    <th class="px-4 py-2 text-left">{{ __('Godzina') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchaseHistory as $purchase)
                                    <tr>
                                        <td class="border px-4 py-2 text-left">
                                            <img src="{{ asset($purchase->course->image) }}" alt="{{ $purchase->course->title }}" class="inline-block mr-2" style="width: 50px; height: 50px; object-fit: cover;">
                                            {{ $purchase->course->title }}
                                        </td>
                                        <td class="border px-4 py-2 text-left">{{ $purchase->created_at->format('d-m-Y') }}</td>
                                        <td class="border px-4 py-2 text-left">{{ $purchase->created_at->format('H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
