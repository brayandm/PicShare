<div>
    <p class="pr-3">Likes: {{ $post->likes }}</p>
    @if ($post->likedPeople()->find(Auth::user()->person->id))
        <button wire:click="unlike" class="border p-2 rounded-xl bg-gray-200">Unlike</button>
    @else
        <button wire:click="like" class="border p-2 rounded-xl bg-gray-200">Like</button>
    @endif
</div>
