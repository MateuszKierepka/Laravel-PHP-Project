<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Moje kursy') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($purchasedCourses->isEmpty())
                        <p class="text-center">Nie masz jeszcze żadnych zakupionych kursów.</p>
                    @else
                        <div class="grid grid-cols-1 gap-6">
                            @foreach($purchasedCourses as $userCourse)
                                <div class="border rounded-lg p-4 flex items-center">
                                    <div class="w-1/4" style="min-width: 150px;">
                                        <img src="{{ asset($userCourse->course->image) }}" alt="{{ $userCourse->course->title }}" class="w-full h-full object-cover rounded-lg" style="width: 150px; height: 150px;">
                                    </div>
                                    <div class="w-1/3 px-4">
                                        <h5 class="font-bold">{{ $userCourse->course->title }}</h5>
                                        <p>{{ $userCourse->course->description }}</p>
                                    </div>
                                    <div class="w-1/3 text-right">
                                        <a href="#" class="btn btn-primary" style="font-size: 1.1rem; padding: 0.1rem 2.5rem;">Przejdź</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @vite('resources/css/styles.css')
</x-app-layout>