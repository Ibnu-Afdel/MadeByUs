@if ($showFormModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-semibold mb-4">New Project</h2>

            <form wire:submit="save" class="space-y-4">

                <x-projects.input wire:model='title' name='title' placeholder='Title' />

                <x-projects.textarea wire:model="description" name="description" placeholder="Description" />

                <x-projects.input type='file' wire:model='image' name='title' placeholder='Title' />
                @if ($image)
                    <div>
                        Preview: <img src="{{ $image->temporaryUrl() }}" alt="">
                    </div>
                @elseif($existingImageUrl)
                    <div>
                        <span class="text-sm text-gray-600">Current Image:</span>
                        <img src="{{ $existingImageUrl }}" class="w-32 h-32 object-cover rounded">
                    </div>
                @endif


                <div class="flex justify-end gap-2">

                    <x-projects.button wire:click='closeModal'
                        class="border border-gray-300 hover:bg-gray-100 dark:hover:bg-zinc-700">Cancel
                    </x-projects.button>

                    <x-projects.button type="submit"
                        class="border border-green-400 bg-green-500 text-white hover:bg-green-600">Save
                    </x-projects.button>

                </div>
            </form>
        </div>
    </div>
@endif