<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-5 w-full mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-col p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl mb-10"> {{ $person->user->name }}</h1>
                    <h2 class="text-xl mb-2">Description:</h2>
                    <p class="mb-5"> {{ $person->description }}</p>
                    <h2 class="text-xl mb-2">Birthdate:</h2>
                    <p class="mb-10"> {{ $person->birthdate }}</p>

                    @if (! Auth::user()->person->followings()->find($person->id))
                        <form action={{ route('profiles.follow', ['id' => $person->id]) }} method="POST">

                            @csrf
                            @method('post')

                            <div class="flex flex-col">
                                <button type="submit"
                                    class="self-end border p-2 rounded-xl bg-gray-200">Follow</button>
                            </div>

                        </form>
                    @else
                        <form action={{ route('profiles.unfollow', ['id' => $person->id]) }} method="POST">

                            @csrf
                            @method('post')

                            <div class="flex flex-col">
                                <button type="submit"
                                    class="self-end border p-2 rounded-xl bg-gray-200">Unfollow</button>
                            </div>

                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
