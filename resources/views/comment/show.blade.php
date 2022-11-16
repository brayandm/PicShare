<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-5 w-full mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col p-6 bg-white border-b border-gray-200">
                    <form action={{ route('dashboard.comment.store', ['id' => $id, 'type' => $type]) }} method="POST">

                        @csrf
                        @method('post')

                        <div class="flex flex-col">
                            <textarea id="text" name="text" class="mb-5 p-4" rows="5"></textarea><br>

                            <button type="submit" class="border p-2 rounded-xl bg-gray-200">Create</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
