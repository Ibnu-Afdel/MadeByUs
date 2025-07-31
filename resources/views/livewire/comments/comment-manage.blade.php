<div>
    @if (session()->has('message'))
        <div class="text-green-500">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save" class="space-y-2">
        <textarea wire:model.defer="body" class="w-full border p-2" rows="3"></textarea>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white">Add Comment</button>
    </form>

    <div class="mt-4 space-y-4">
        @foreach ($comments as $comment)
            <div class="border p-2">
                <p class="text-sm text-gray-500">{{ $comment->user->name }}:</p>
                <p>{{ $comment->body }}</p>
            </div>
        @endforeach
    </div>
</div>
