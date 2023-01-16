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
                    <div class="mt-8 w-1/2 mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="flex flex-col content-center p-6 bg-white border-b border-gray-200">
                            <p class="mb-5 text-end">{{ (new Datetime($post->created_at))->format('Y-m-d H:i') }}</p>
                            @if (Auth::user()->person->id != $post->person->id)
                                <a class="mb-5 text-end underline"
                                    href={{ route('profiles.show', ['id' => $post->person->id]) }}>{{ $post->person->user->name }}</a>
                            @else
                                <a class="mb-5 text-end underline"
                                    href={{ route('profile.show') }}>{{ $post->person->user->name }}</a>
                            @endif
                            <h1 class="mb-10 text-xl self-center text-justify">{{ $post->header }}</h1>
                            @if ($post->picture)
                                <img class="mb-5 self-center"
                                    src={{ route('picture.get', ['picture' => $post->picture]) }} alt="picture"
                                    width="300" height="300">
                            @endif
                            <p class="mb-5 self-center text-justify">{{ $post->text }}</p>
                            <div class="flex flex-row items-center">
                                <livewire:liker :post="$post" />
                            </div>
                            <br>

                            <div class="flex flex-row mb-8">
                                <p class="pr-3 self-center">Tags:</p>
                                @foreach ($post->tags()->get() as $tag)
                                    <div class="border p-2 rounded-xl bg-gray-200 mr-3">
                                        <a href={{ route('dashboard.tag', ['id' => $tag->id]) }}
                                            class="self-end border p-2 rounded-xl bg-gray-200">{{ $tag->keyword }}</a>
                                    </div>
                                @endforeach
                            </div>

                            <div class="flex flex-col">
                                <a href={{ route('dashboard.comment.create', ['id' => $post->id, 'type' => 'post']) }}
                                    class="self-end border p-2 rounded-xl bg-gray-200">Comment</a>
                            </div>
                        </div>
                    </div>
                    @php
                        $stack = [[$post, 0]];

                        $comments = [];

                        while (count($stack)) {
                            $last = array_pop($stack);

                            if ($last[1]) {
                                $comments[] = $last;
                            }

                            $temp = [];

                            foreach ($last[0]->comments()->get() as $comment) {
                                array_push($temp, [$comment, $last[1] + 1]);
                            }

                            $temp = array_reverse($temp);

                            foreach ($temp as $comment) {
                                array_push($stack, $comment);
                            }
                        }

                    @endphp

                    @foreach ($comments as $comment)
                        <div style="width:40%"z class="mx-auto">
                            <div class="mt-1 w-full bg-white overflow-hidden shadow-sm sm:rounded-lg"
                                style="margin-left:{{ ($comment[1] - 1) * 50 }}px">
                                <div class="p-6 bg-gray-300 border-b border-gray-200">
                                    <p> <b><u>
                                                @if (Auth::user()->person->id != $comment[0]->person_id)
                                                    <a class="mb-5 text-end underline"
                                                        href={{ route('profiles.show', ['id' => $comment[0]->person_id]) }}>{{ App\Models\Person::find($comment[0]->person_id)->user->name }}</a>
                                                @else
                                                    <a class="mb-5 text-end underline"
                                                        href={{ route('profile.show') }}>{{ App\Models\Person::find($comment[0]->person_id)->user->name }}</a>
                                                @endif
                                            </u></b>
                                    </p>
                                    <br>
                                    <p> {{ $comment[0]->text }}</p>
                                    <div class="flex flex-col">
                                        <a href={{ route('dashboard.comment.create', ['id' => $comment[0]->id, 'type' => 'comment']) }}
                                            class="self-end border p-2 rounded-xl bg-gray-200">Comment</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
