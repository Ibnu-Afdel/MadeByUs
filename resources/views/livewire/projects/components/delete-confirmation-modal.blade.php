@if ($confirmingDeleteId)
   <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg w-full max-w-md p-6">
                <h2 class="text-lg font-semibold mb-4">Delete Project</h2>
                <p>Are you sure you want to delete this project? This action cannot be undone.</p>

                <div class="mt-4 flex justify-end gap-2">
                    <button
                        wire:click="$set('confirmingDeleteId', null)"
                        class="px-3 py-2 rounded bg-gray-600 hover:bg-gray-700 hover:cursor-pointer"
                    >
                        Cancel
                    </button>
                    <button
                        wire:click="destroy()"
                        class="px-3 py-2 rounded bg-red-500 text-white hover:bg-red-600 hover:cursor-pointer"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>
@endif