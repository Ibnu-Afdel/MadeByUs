<div class="max-w-4xl mx-auto px-4 py-8">

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">

        <div class="h-64 bg-gradient-to-br from-green-500 to-green-700 relative overflow-hidden">
            @if($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
            @else
                <div class="h-full w-full flex items-center justify-center">
                    <svg class="w-24 h-24 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            @endif
            
            <div class="absolute top-6 right-6">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 shadow-lg">
                    <svg class="w-3 h-3 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                        <circle cx="10" cy="10" r="3"></circle>
                    </svg>
                    {{ ucfirst($project->status) }}
                </span>
            </div>
        </div>
        
        <!-- Content Section -->
        <div class="p-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">{{ $project->title }}</h1>
                <div class="flex items-center text-gray-600 dark:text-gray-400">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-sm font-medium">Created by {{ $project->user->name }}</span>
                </div>
            </div>
            
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Description</h3>
                <div class="prose prose-gray dark:prose-invert max-w-none">
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $project->description }}</p>
                </div>
            </div>
            
            <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Project Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a1 1 0 011-1h6a1 1 0 011 1v4h3a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2h3z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ ucfirst($project->status) }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Created</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $project->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3">
                @auth
                    @if(auth()->user()->id === $project->user_id)
                        <!-- Owner can edit the project -->
                        <button wire:click='triggerEdit' class="inline-flex items-center justify-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Edit Project
                        </button>
                        
                        <a href="{{ route('projects.manage') }}" class="inline-flex items-center justify-center px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Manage Projects
                        </a>
                    @endif
                @endauth
                
                <!-- Always show back to home for public users -->
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Projects
                </a>
            </div>
        </div>
    </div>
</div>
