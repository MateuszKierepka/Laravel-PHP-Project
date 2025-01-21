@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <h1 class="text-2xl font-semibold leading-tight mb-6">{{ __('Zarządzaj kursami') }}</h1>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">{{ __('Tytuł') }}</th>
                                    <th class="px-4 py-2 text-left">{{ __('Opis') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <td class="border px-4 py-2 text-left">
                                                <input type="text" name="title" value="{{ $course->title }}" class="w-full">
                                            </td>
                                            <td class="border px-4 py-2 text-left">
                                                <textarea name="description" class="w-full">{{ $course->description }}</textarea>
                                            </td>
                                            <td class="px-4 py-2 text-left">
                                                <button type="submit" class="text-blue-500 ml-4">{{ __('Zapisz') }}</button>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
