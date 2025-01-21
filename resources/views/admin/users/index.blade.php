@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    <h1 class="text-2xl font-semibold leading-tight mb-6">{{ __('Lista użytkowników') }}</h1>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">{{ __('Nazwa') }}</th>
                                    <th class="px-4 py-2 text-left">{{ __('Email') }}</th>
                                    <th class="px-4 py-2 text-left">{{ __('Posiadane kursy') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="border px-4 py-2 text-left">{{ $user->name }}</td>
                                        <td class="border px-4 py-2 text-left">{{ $user->email }}</td>
                                        <td class="border px-4 py-2 text-left">
                                            @foreach($user->courses as $course)
                                                <div class="flex justify-between items-center">
                                                    <span>{{ $course->title }}</span>
                                                    <form action="{{ route('admin.users.removeCourse', [$user->id, $course->id]) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-500 ml-4">{{ __('Usuń kurs') }}</button>
                                                    </form>
                                                </div>
                                            @endforeach
                                        </td>
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