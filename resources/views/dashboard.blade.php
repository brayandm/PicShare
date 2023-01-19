<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (!Auth::user()->is_admin)

                {{ $posts->links() }}

                @foreach ($posts as $post)
                    <livewire:poster :post="$post" />
                @endforeach

                {{ $posts->links() }}
            @else
                <div class="mb-5 w-1/2 mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-col items-center">
                            <h1 class="text-xl">Welcome Admin</h1>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
