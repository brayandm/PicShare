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
                    <h1 class="text-2xl mb-10"> {{ $person->user->name }}</h1>

                    <form action={{ route('profile.edit') }} method="POST">

                        @csrf
                        @method('put')

                        <div class="flex flex-col">
                            <label for="description" class="text-xl">Description:</label><br>
                            <textarea id="description" name="description" class="mb-5 p-4" rows="5">{{ $person->description }}</textarea><br>

                            <label for="birthdate" class="text-xl">Birthdate:</label><br>
                            <input type="date" id="birthdate" name="birthdate" value="{{ $person->birthdate }}"
                                class="mb-5"><br>

                            <button type="submit" class="border p-2 rounded-xl bg-gray-200">Edit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
