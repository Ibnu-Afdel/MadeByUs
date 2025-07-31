@if ($confirmingDeleteId)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/40 backdrop-blur-sm">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
            
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-4">

                    <div class="flex items-center justify-center w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-full">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Delete Project</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">This action cannot be undone</p>
                    </div>
                </div>
            </div>


            <div class="p-6">
                <p class="text-gray-700 dark:text-gray-300">
                    Are you sure you want to permanently delete this project? All project data, images, and settings will be removed.
                </p>
            </div>


            <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                <button type="button" wire:click="$set('confirmingDeleteId', null)"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-700 transition-colors duration-200">
                    Cancel
                </button>

                <button type="button" wire:click="destroy()"
                    class="inline-flex items-center px-6 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:outline-none transition-all duration-200"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="destroy" class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Delete Project
                    </span>
                    <span wire:loading wire:target="destroy" class="flex items-center">
                        <svg class="animate-spin w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                        Deleting...
                    </span>
                </button>
            </div>
        </div>
    </div>
@endif