<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Mobile-optimized back button -->
    <div class="sticky top-0 z-50 bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm border-b border-gray-200 dark:border-gray-700 px-4 py-3 md:px-6">
        <div class="max-w-7xl mx-auto">
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-green-600 dark:text-gray-400 dark:hover:text-green-400 transition-colors duration-200 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Projects
            </a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-6 md:px-6 lg:px-8">
        <!-- Main Content Layout -->
        <div class="lg:grid lg:grid-cols-12 lg:gap-8">
            
            <!-- Project Content (Main Column) -->
            <div class="lg:col-span-8">
                
                <!-- Project Header Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700 mb-6">
                    
                    <!-- Hero Image Section -->
                    <div class="relative h-48 sm:h-64 lg:h-80">
                        @if($project->getFirstMediaUrl('images'))
                            <img src="{{ $project->getFirstMediaUrl('images') }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                        @else
                            <div class="h-full w-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                                <svg class="w-16 h-16 sm:w-24 sm:h-24 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        @endif

                        <!-- Mobile-optimized badges -->
                        <div class="absolute top-3 left-3 flex flex-col gap-2 sm:flex-row sm:gap-2">
                            @if($project->is_featured)
                                <span class="inline-flex items-center px-2 py-1 sm:px-3 sm:py-1.5 rounded-full text-xs sm:text-sm font-semibold bg-amber-500 text-white shadow-lg">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    FEATURED
                                </span>
                            @endif
                            
                            @if($project->is_priority)
                                <span class="inline-flex items-center px-2 py-1 sm:px-3 sm:py-1.5 rounded-full text-xs sm:text-sm font-bold bg-green-600 text-white shadow-lg">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732L14.146 12.8l-1.179 4.456a1 1 0 01-1.934 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732L9.854 7.2l1.179-4.456A1 1 0 0112 2z" clip-rule="evenodd"></path>
                                    </svg>
                                    PRO
                                </span>
                            @endif
                        </div>



                        <!-- View count -->
                        @if($project->view_count > 0)
                            <div class="absolute bottom-3 right-3">
                                <span class="inline-flex items-center px-2 py-1 sm:px-3 sm:py-1.5 rounded-full text-xs sm:text-sm font-medium bg-black/50 text-white shadow-lg backdrop-blur-sm">
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span class="hidden sm:inline">{{ number_format($project->view_count) }} views</span>
                                    <span class="sm:hidden">{{ number_format($project->view_count) }}</span>
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Project Info Section -->
                    <div class="p-4 sm:p-6 lg:p-8">
                        <!-- Title and Meta -->
                        <div class="mb-6">
                            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-3 leading-tight">{{ $project->title }}</h1>
                            <div class="flex flex-col sm:flex-row sm:items-center text-gray-600 dark:text-gray-400 text-sm sm:text-base">
                                <div class="flex items-center mb-2 sm:mb-0">
                                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium">{{ $project->user->name }}</span>
                                </div>
                                <span class="hidden sm:inline mx-3 text-gray-400">•</span>
                                <span>{{ $project->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">About This Project</h3>
                            <div class="prose prose-gray dark:prose-invert max-w-none">
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $project->description }}</p>
                            </div>
                        </div>

                        <!-- Technologies -->
                        @if($project->tags->isNotEmpty())
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3">Technologies Used</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($project->tags as $tag)
                                        <a href="{{ route('home', ['tag' => $tag->name]) }}" 
                                           class="inline-block bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200 text-sm font-medium px-3 py-1.5 rounded-full hover:bg-green-200 dark:hover:bg-green-900/70 transition-colors duration-200 cursor-pointer">
                                            {{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex flex-col gap-3 sm:flex-row sm:gap-4">
                            @auth
                                @if(auth()->user()->id === $project->user_id)
                                    <button wire:click='triggerEdit' 
                                            class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 shadow-lg hover:shadow-xl">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit Project
                                    </button>
                                    
                                    <a href="{{ route('projects.manage') }}" 
                                       class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-semibold rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 border-2 border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                        Manage Projects
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- Sidebar (Desktop) / Bottom Section (Mobile) -->
            <div class="lg:col-span-4 space-y-6">
                
                <!-- Project Stats Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Project Stats</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-600 dark:text-gray-400">Views</span>
                            </div>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ number_format($project->view_count) }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-600 dark:text-gray-400">Technologies</span>
                            </div>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $project->tags->count() }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-600 dark:text-gray-400">Created</span>
                            </div>
                            <span class="font-semibold text-gray-900 dark:text-white">{{ $project->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Related Projects -->
                @if($project->tags->isNotEmpty())
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Explore Similar</h3>
                            <a href="{{ route('home', ['tag' => $project->tags->first()->name]) }}" 
                               class="text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 font-medium text-sm hover:underline">
                                View all →
                            </a>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Projects using similar technologies</p>
                        
                        <div class="space-y-3">
                            @foreach($project->tags->take(4) as $tag)
                                <a href="{{ route('home', ['tag' => $tag->name]) }}" 
                                   class="group flex items-center p-3 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-green-300 dark:hover:border-green-600 hover:bg-green-50 dark:hover:bg-green-900/10 transition-all duration-200">
                                    <div class="flex items-center justify-center w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg group-hover:bg-green-200 dark:group-hover:bg-green-900/50 transition-colors duration-200 mr-3">
                                        <span class="text-green-600 dark:text-green-400 font-bold text-xs">{{ strtoupper(substr($tag->name, 0, 2)) }}</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-medium text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200 truncate">{{ $tag->name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $tag->taggables_count ?? 0 }} projects</p>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Comments Section - Full Width on All Screens -->
        <div class="mt-8">
            <livewire:comments.comment-manage :project="$project" />
        </div>
    </div>
</div>
