@if ($showFormModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden">

            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ $editingProject ? 'Edit Project' : 'Create New Project' }}
                </h2>
                <button wire:click="closeModal" 
                    class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal Content - Scrollable -->
            <div class="overflow-y-auto max-h-[calc(90vh-180px)]">
                <form wire:submit="save" class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        
                        <!-- Left Column - Form Fields -->
                        <div class="space-y-6">

                            <div class="space-y-2">
                                <flux:input wire:model="title" label="Project Title" placeholder="Enter your project title" name="title" 
                                    class="w-full" />
                            </div>

                            <div class="space-y-2">
                                <flux:textarea wire:model="description" label="Description" placeholder="Describe your project..." 
                                    name="description" rows="6" class="w-full resize-none" />
                            </div>


                            <div class="space-y-2">
                                <flux:input type="text" wire:model="tags" label="Technologies & Tags" 
                                    placeholder="React, Laravel, TypeScript..." class="w-full" />
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Separate multiple tags with commas
                                </p>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Image Upload Section -->
                            <div class="space-y-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Project Image
                                </label>

                                <div class="relative">
                                    <flux:input type="file" wire:model="image" 
                                        class="w-full file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100 dark:file:bg-green-900/20 dark:file:text-green-300" />

                                    <div wire:loading wire:target="image" class="absolute inset-0 bg-white/80 dark:bg-gray-800/80 rounded-lg flex items-center justify-center">
                                        <div class="text-sm text-green-600 dark:text-green-400 flex items-center gap-2">
                                            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                                            </svg>
                                            Uploading image...
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    @if ($image)
                                        <!-- New Image Preview -->
                                        <div class="relative">
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">New Image Preview:</p>
                                            <div class="relative group">
                                                <img src="{{ $image->temporaryUrl() }}" 
                                                    class="w-full h-48 object-cover rounded-xl border-2 border-gray-200 dark:border-gray-600 shadow-sm"
                                                    alt="New preview">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-xl"></div>

                                                <button type="button" wire:click="$set('image', null)"
                                                    class="absolute top-2 right-2 p-1.5 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200 hover:bg-red-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @elseif($existingImageUrl)
                                        <div class="relative">
                                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current Image:</p>
                                            <div class="relative group">
                                                <img src="{{ $existingImageUrl }}" 
                                                    class="w-full h-48 object-cover rounded-xl border-2 border-gray-200 dark:border-gray-600 shadow-sm"
                                                    alt="Current image">
                                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent rounded-xl"></div>
                                                <div class="absolute bottom-2 left-2 px-2 py-1 bg-black/50 text-white text-xs rounded-md backdrop-blur-sm">
                                                    Current
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center">
                                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                Upload an image to showcase your project
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                <div class="text-xs text-gray-500 dark:text-gray-400 space-y-1">
                                    <p>• Recommended: 1200x600px or 2:1 aspect ratio</p>
                                    <p>• Maximum size: 1MB</p>
                                    <p>• Formats: JPG, PNG, WebP</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                <button type="button" wire:click="closeModal"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-700 transition-colors duration-200">
                    Cancel
                </button>

                <button type="submit" wire:click="save"
                    class="inline-flex items-center px-6 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:outline-none disabled:opacity-50 transition-all duration-200"
                    wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save" class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ $editingProject ? 'Update Project' : 'Create Project' }}
                    </span>
                    <span wire:loading wire:target="save" class="flex items-center">
                        <svg class="animate-spin w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                        {{ $editingProject ? 'Updating...' : 'Creating...' }}
                    </span>
                </button>
            </div>
        </div>
    </div>
@endif