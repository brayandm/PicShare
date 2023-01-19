<div>
    <div class="mt-8 w-1/2 mx-auto bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex flex-col content-center p-6 bg-white border-b border-gray-200">
            <p class="mb-5 text-end">{{ (new Datetime($post->created_at))->format('Y-m-d H:i') }}</p>
            @if (Auth::user()->person->id != $post->person->id)
                <a class="mb-5 text-end underline"
                    href={{ route('profiles.show', ['id' => $post->person->id]) }}>{{ $post->person->user->name }}</a>
            @else
                <a class="mb-5 text-end underline" href={{ route('profile.show') }}>{{ $post->person->user->name }}</a>
            @endif
            <h1 class="mb-10 text-xl self-center text-justify">{{ $post->header }}</h1>
            @if ($post->picture)
                <img class="mb-5 self-center" src={{ route('picture.get', ['picture' => $post->picture]) }} alt="picture"
                    width="300" height="300">
            @endif
            <p class="mb-5 self-center text-justify">{{ $post->text }}</p>
            <div class="flex flex-row items-center">
                <p class="pr-3">Likes: {{ $post->likes }}</p>
                @if ($post->likedPeople()->find(Auth::user()->person->id))
                    <button wire:click="unlike" class="border p-2 rounded-xl bg-gray-200">Unlike</button>
                @else
                    <button wire:click="like" class="border p-2 rounded-xl bg-gray-200">Like</button>
                @endif
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
                @if ($active == 0)
                    <input wire:model="message" type="text" class="rounded-xl">
                    <button wire:click="send({{ $post->id }}, '{{ 'post' }}')"
                        class="self-end border ml-2 mt-4 p-2 rounded-xl bg-gray-200">Send</button>
                @else
                    <div class="flex flex-col">
                        <button wire:click="activeComment({{ 0 }})"
                            class="self-end border p-2 rounded-xl bg-gray-200">Comment</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @php
        $counter = 0;
    @endphp

    @foreach ($comments as $comment)
        @php
            $counter++;
        @endphp
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

                    @if ($comment[2])
                        <input wire:model="message" type="text" class="rounded-xl bg-gray-200">
                        <button wire:click="send({{ $comment[0]->id }}, '{{ 'comment' }}')"
                            class="self-end border ml-2 mt-4 p-2 rounded-xl bg-gray-200">Send</button>
                    @else
                        <div class="flex flex-col">
                            <button wire:click="activeComment({{ $counter }})"
                                class="self-end border p-2 rounded-xl bg-gray-200">Comment</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
