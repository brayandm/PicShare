<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($users as $user)
                @if (!$user->is_admin)
                    <div class="mb-5 w-1/2 mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="flex flex-col p-6 bg-white border-b border-gray-200">
                            <h1 class="text-lg">Name:</h1>
                            <p>{{ $user->name }}</p>
                            <br>
                            <h1 class="text-lg">Email:</h1>
                            <p>{{ $user->email }}</p>
                            <br>

                            <div class="self-end">
                                <form action={{ route('users.delete', ['id' => $user->id]) }} method="POST">

                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="border p-2 rounded-xl bg-gray-200">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-app-layout>
