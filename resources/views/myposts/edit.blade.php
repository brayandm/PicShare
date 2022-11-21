<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-5 w-1/2 mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col p-6 bg-white border-b border-gray-200">

                    @if ($errors->any())
                        <div class="text-red-600 bg-red-50 rounded-sm p-1">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <br>

                    <h1 class="text-2xl mb-10"> {{ $post->person->user->name }}</h1>

                    <form action={{ route('myposts.update', ['id' => $post->id]) }} method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        @method('put')

                        <div class="flex flex-col">
                            <label for="header" class="text-xl">Header:</label><br>
                            <input type="text" id="header" name="header" value="{{ $post->header }}"
                                class="mb-5"><br>

                            @if ($post->picture)
                                <img class="mb-5 self-center"
                                    src={{ route('picture.get', ['picture' => $post->picture]) }} alt="picture"
                                    width="300" height="300">
                            @endif

                            <label for="text" class="text-xl">Picture:</label><br>
                            <input type="file" name="picture" class="mb-5" />

                            <label for="text" class="text-xl">Text:</label><br>
                            <textarea id="text" name="text" class="mb-5 p-3" rows="5">{{ $post->text }}</textarea><br>

                            @php
                                $tags = '';
                                foreach ($post->tags()->get() as $tag) {
                                    if ($tags != '') {
                                        $tags .= ', ';
                                    }
                                    $tags .= $tag->keyword;
                                }
                            @endphp

                            <label for="header" class="text-xl">Tags:</label el><br>
                            <input type="text" id="tags" name="tags" value="{{ $tags }}"
                                class="mb-5"><br>

                            <button type="submit" class="self-end border p-2 rounded-xl bg-gray-200">Edit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
