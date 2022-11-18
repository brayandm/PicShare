<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href={{ route('myposts.create') }}>
                <div class="mb-5 w-full mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <p class="text-center text-xl">Create New Post</p>
                    </div>
                </div>
            </a>
            @php
                $posts = collect($posts)->sortByDesc('created_at');
            @endphp
            @foreach ($posts as $post)
                <div class="mb-5 w-1/2 mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col p-6 bg-white border-b border-gray-200">
                        <p class="mb-5 text-end">{{ (new Datetime($post->created_at))->format('Y-m-d H:i') }}</p>
                        <p class="mb-5 text-end">{{ $post->person->user->name }}</p>
                        <h1 class="mb-10 text-xl">{{ $post->header }}</h1>
                        @if ($post->picture)
                            <img class="mb-5" src={{ route('picture.get', ['picture' => $post->picture]) }}
                                alt="picture" width="300" height="300">
                        @endif
                        <p class="mb-5">{{ $post->text }}</p>
                        <p class="mb-10">Likes: {{ $post->likes }}</p>

                        <div class="self-end flex flex-row">
                            <a href={{ route('myposts.edit', [$post->id]) }}
                                class="border p-2 rounded-xl bg-gray-200 mr-3">Edit</a>

                            <form action={{ route('myposts.delete', ['id' => $post->id]) }} method="POST">

                                @csrf
                                @method('delete')
                                <button type="submit" class="border p-2 rounded-xl bg-gray-200">Delete</button>
                            </form>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
