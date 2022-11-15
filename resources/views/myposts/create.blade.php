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
                    <form action={{ route('myposts.create') }} method="POST">

                        @csrf
                        @method('post')

                        <div class="flex flex-col">
                            <label for="header" class="text-xl">Header:</label><br>
                            <input type="text" id="header" name="header" value=""
                                class="mb-5"><br>

                            <label for="text" class="text-xl">Text:</label><br>
                            <textarea id="text" name="text" class="mb-5 p-3" rows="5"></textarea><br>

                            <button type="submit" class="self-end border p-2 rounded-xl bg-gray-200">Create</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>