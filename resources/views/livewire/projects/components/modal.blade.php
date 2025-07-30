@if ($showFormModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-semibold mb-4">New Project</h2>

            <form wire:submit="save" class="space-y-4">
                {{-- <x-projects.input wire:model='title' name='title' placeholder='Title' /> --}}
                <flux:input wire:model="title" label="Title" placeholder="Title" name="title" />

                {{-- <x-projects.textarea wire:model="description" name="description" placeholder="Description" /> --}}
                <flux:textarea wire:model="description" label="Description" placeholder="Description" name="description" />

                 {{-- <x-projects.input type='file' wire:model='image' name='title' placeholder='Title' /> --}}
                <div>
                    <flux:input type="file" wire:model="image" label="Image" />

                    <div wire:loading wire:target="image" class="text-sm text-blue-500 mt-2 flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                  d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                        Uploading image...
                    </div>

                    @if ($image)
                        <div class="mt-3">
                            <span class="text-sm text-gray-600">Preview:</span>
                            <img src="{{ $image->temporaryUrl() }}"
                                 class="w-32 h-32 object-cover rounded-lg border mt-1" alt="Preview">
                        </div>
                    @elseif($existingImageUrl)
                        <div class="mt-3">
                            <span class="text-sm text-gray-600">Current Image:</span>
                            <img src="{{ $existingImageUrl }}"
                                 class="w-32 h-32 object-cover rounded-lg border mt-1" alt="Current">
                        </div>
                    @endif
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <x-projects.button wire:click='closeModal'
                        class="border border-gray-300 hover:bg-gray-100 dark:hover:bg-zinc-700">
                        Cancel
                    </x-projects.button>

                    <x-projects.button type="submit"
                        class="border border-green-400 bg-green-500 text-white hover:bg-green-600"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="save">Save</span>
                        <span wire:loading wire:target="save">Saving...</span>
                    </x-projects.button>
                </div>
            </form>
        </div>
    </div>
@endif
