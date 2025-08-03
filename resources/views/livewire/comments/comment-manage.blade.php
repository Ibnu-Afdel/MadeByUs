<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-3">
        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white flex items-center">
            <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 sm:mr-3 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <span>Comments & Discussion</span>
        </h3>
        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200 self-start sm:self-center">
            {{ $comments->count() }} {{ Str::plural('comment', $comments->count()) }}
        </span>
    </div>

    @auth
        <!-- Comment Form -->
        <div class="mb-6 sm:mb-8">
            <form wire:submit.prevent="save" class="space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-start space-y-3 sm:space-y-0 sm:space-x-4">
                    <div class="flex-shrink-0 self-start">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-xs sm:text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="relative">
                            <textarea 
                                wire:model.defer="body" 
                                placeholder="Share your thoughts about this project..."
                                class="w-full px-3 py-2.5 sm:px-4 sm:py-3 border border-gray-300 dark:border-gray-600 rounded-lg sm:rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-700 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 resize-none transition-all duration-200 shadow-sm text-sm sm:text-base"
                                rows="3"
                            ></textarea>
                            @error('body')
                                <div class="mt-2 flex items-start text-red-600 dark:text-red-400">
                                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-sm">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-3 gap-2">
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                                Commenting as <span class="font-medium text-gray-700 dark:text-gray-300">{{ auth()->user()->name }}</span>
                            </p>
                            <button 
                                type="submit" 
                                class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 sm:px-6 sm:py-2.5 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg sm:rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed text-sm sm:text-base"
                                wire:loading.attr="disabled"
                            >
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" wire:loading.remove>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                <svg class="w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24" wire:loading>
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span wire:loading.remove>Post Comment</span>
                                <span wire:loading>Posting...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @else
        <!-- Guest prompt -->
        <div class="mb-6 sm:mb-8 p-4 sm:p-6 bg-gray-50 dark:bg-gray-700/50 rounded-lg sm:rounded-xl border border-gray-200 dark:border-gray-600">
            <div class="text-center">
                <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400 mx-auto mb-3 sm:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <h4 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-2">Join the Discussion</h4>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mb-4">Sign in to share your thoughts and connect with other developers.</p>
                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 justify-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 text-sm sm:text-base">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-medium rounded-lg border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200 text-sm sm:text-base">
                        Create Account
                    </a>
                </div>
            </div>
        </div>
    @endauth

    @if ($comments->count() > 0)
        <!-- Comments List -->
        <div class="space-y-4 sm:space-y-6">
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 sm:pt-6">
                <h4 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    All Comments ({{ $comments->count() }})
                </h4>
            </div>

            @foreach ($comments as $comment)
                <div class="p-3 sm:p-4 rounded-lg sm:rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-600/50 transition-all duration-200 hover:border-gray-200 dark:hover:border-gray-500">
                    <div class="flex space-x-3 sm:space-x-4">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-400 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                                <span class="text-white font-bold text-xs sm:text-sm">{{ substr($comment->user->name, 0, 1) }}</span>
                            </div>
                        </div>
                        
                        <!-- Comment Content -->
                        <div class="flex-1 min-w-0">
                            <!-- Comment Header -->
                            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 mb-2 gap-1 sm:gap-0">
                                <h5 class="font-semibold text-gray-900 dark:text-white text-sm sm:text-base">{{ $comment->user->name }}</h5>
                                <div class="flex items-center space-x-2 text-xs sm:text-sm">
                                    <span class="hidden sm:inline text-gray-400">•</span>
                                    <span class="text-gray-500 dark:text-gray-400" title="{{ $comment->created_at->format('M d, Y \a\t g:i A') }}">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                    @if($comment->created_at != $comment->updated_at)
                                        <span class="text-xs text-gray-400 dark:text-gray-500">(edited)</span>
                                    @endif
                                </div>
                            </div>

                            @if($editingCommentId === $comment->id)
                                <!-- Edit Form -->
                                <form wire:submit.prevent="updateComment" class="space-y-3">
                                    <div class="relative">
                                        <textarea 
                                            wire:model.defer="editBody" 
                                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 dark:bg-gray-600 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 resize-none transition-all duration-200 text-sm"
                                            rows="3"
                                        ></textarea>
                                        @error('editBody')
                                            <div class="mt-1 flex items-start text-red-600 dark:text-red-400">
                                                <svg class="w-3 h-3 mr-1 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                </svg>
                                                <span class="text-xs">{{ $message }}</span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center space-y-2 sm:space-y-0 sm:space-x-2">
                                        <button 
                                            type="submit" 
                                            class="inline-flex items-center justify-center px-3 py-1.5 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors duration-200"
                                            wire:loading.attr="disabled"
                                        >
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" wire:loading.remove>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <svg class="w-3 h-3 mr-1 animate-spin" fill="none" viewBox="0 0 24 24" wire:loading>
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 818-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <span wire:loading.remove>Update</span>
                                            <span wire:loading>Updating...</span>
                                        </button>
                                        <button 
                                            type="button" 
                                            wire:click="cancelEdit"
                                            class="inline-flex items-center justify-center px-3 py-1.5 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 text-sm font-medium rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200"
                                        >
                                            Cancel
                                        </button>
                                    </div>
                                </form>
                            @else
                                <!-- Comment Text -->
                                <div class="mb-3">
                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-sm sm:text-base break-words">{{ $comment->body }}</p>
                                </div>
                                
                                <!-- Action Buttons -->
                                @auth
                                    @if(auth()->user()->id === $comment->user_id)
                                        <div class="flex flex-wrap items-center gap-2 sm:gap-4 pt-2 border-t border-gray-200 dark:border-gray-600">
                                            <button 
                                                wire:click="editComment({{ $comment->id }})"
                                                class="inline-flex items-center text-xs sm:text-sm text-gray-500 hover:text-green-600 dark:text-gray-400 dark:hover:text-green-400 font-medium transition-colors duration-200"
                                            >
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </button>
                                            <button 
                                                wire:click="confirmDelete({{ $comment->id }})"
                                                class="inline-flex items-center text-xs sm:text-sm text-gray-500 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400 font-medium transition-colors duration-200"
                                            >
                                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-8 sm:py-12">
            <svg class="w-12 h-12 sm:w-16 sm:h-16 text-gray-300 dark:text-gray-600 mx-auto mb-3 sm:mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <h4 class="text-lg sm:text-xl font-semibold text-gray-400 dark:text-gray-500 mb-2">No comments yet</h4>
            <p class="text-sm sm:text-base text-gray-500 dark:text-gray-400">Be the first to share your thoughts about this project!</p>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($confirmingDeleteId)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/40 backdrop-blur-sm">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">
                
                <div class="p-4 sm:p-6 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-start gap-3 sm:gap-4">
                        <div class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 bg-red-100 dark:bg-red-900/30 rounded-full flex-shrink-0">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.664-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">Delete Comment</h2>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">This action cannot be undone</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-6">
                    <p class="text-sm sm:text-base text-gray-700 dark:text-gray-300">
                        Are you sure you want to permanently delete this comment? It will be removed from the discussion.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center sm:justify-end gap-2 sm:gap-3 p-4 sm:p-6 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                    <button type="button" wire:click="$set('confirmingDeleteId', null)"
                        class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 dark:bg-gray-600 dark:text-gray-300 dark:border-gray-500 dark:hover:bg-gray-700 transition-colors duration-200">
                        Cancel
                    </button>

                    <button type="button" wire:click="destroy()"
                        class="inline-flex items-center justify-center px-6 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:outline-none transition-all duration-200"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="destroy" class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Delete Comment
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
</div>
