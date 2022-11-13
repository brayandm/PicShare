<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($posts as $post)
                <div class="mb-5 w-1/2 mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <p class="mb-5 text-end">{{ $post->person->user->name }}</p>
                        <h1 class="mb-10 text-xl">{{ $post->header }}</h1>
                        <p class="mb-5">{{ $post->text }}</p>
                        <p>Likes: {{ $post->likes }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
