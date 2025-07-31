<div class="min-h-screen bg-gradient-to-br from-gray-50 to-green-50/30 dark:from-gray-900 dark:to-gray-800">
    
    <div class="relative overflow-hidden text-gray-900 dark:text-white">
        <div class="relative container mx-auto px-4 py-16 lg:py-24">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-5xl lg:text-7xl font-bold mb-6 text-gray-900 dark:text-white">
                    Discover Amazing Projects
                </h1>
                <p class="text-xl lg:text-2xl text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto">
                    Explore innovative projects created by our talented community
                </p>

                <div class="max-w-2xl mx-auto">
                    <div class="relative">
                        <!-- Search Icon -->
                        <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        

                        <input 
                            type="text" 
                            wire:model.live.debounce.1000ms="search" 
                            placeholder="Search projects by title or tags..."
                            class="block w-full pl-14 pr-6 py-5 text-lg border border-gray-200 dark:border-gray-600 rounded-2xl bg-white/95 backdrop-blur text-gray-900 dark:bg-gray-800 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-green-500/30 focus:border-green-500 transition-all duration-200 shadow-lg"
                        >
                        

                        <div wire:loading wire:target="search" class="absolute inset-y-0 right-0 pr-6 flex items-center justify-center">
                            <svg class="animate-spin h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 818-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                        

                        @if($search)
                            <button 
                                wire:click="$set('search', '')" 
                                class="absolute inset-y-0 right-0 pr-6 flex items-center text-gray-400 hover:text-gray-600 transition-colors"
                                type="button"
                            >
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        @endif
                    </div>

                    @if($search)
                        <div class="mt-4 text-center text-gray-600 dark:text-gray-300">
                            Found <span class="font-bold text-gray-900 dark:text-white">{{ $featuredProjects->count() + $priorityProjects->count() + $projects->count() }}</span> projects for "<span class="font-semibold text-green-600 dark:text-green-400">{{ $search }}</span>"
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4">

        <!-- Featured Projects Section -->
        @if($featuredProjects->isNotEmpty())
            <section class="py-16">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center px-4 py-2 bg-amber-50 text-amber-700 dark:bg-amber-900/20 dark:text-amber-400 rounded-full text-sm font-medium mb-4">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        Featured Projects
                    </div>
                    <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Spotlight Projects</h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Hand-picked exceptional projects from our community</p>
                </div>
                
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($featuredProjects as $project)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                            <!-- Featured Badge -->
                            <div class="absolute top-3 left-3 z-10">
                                <span class="inline-flex items-center px-2 py-1 bg-amber-600 text-white text-xs font-medium rounded-lg">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    FEATURED
                                </span>
                            </div>
                            
                            @if($project->getFirstMediaUrl('images'))
                                <div class="h-48 bg-amber-100 dark:bg-amber-900/20 relative">
                                    <img src='{{ $project->getFirstMediaUrl('images') }}' alt="{{ $project->title }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="h-48 bg-amber-100 dark:bg-amber-900/20 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-amber-600/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                    <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">{{ $project->description }}</p>
                                
                                <div class="mb-4 flex flex-wrap gap-2">
                                    @foreach($project->tags as $tag)
                                        <span class="inline-block bg-amber-100 text-amber-800 dark:bg-amber-900/50 dark:text-amber-200 text-xs font-medium px-3 py-1 rounded-full">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        by {{ $project->user->name }}
                                    </div>
                                    <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-amber-700 bg-amber-50 hover:bg-amber-100 dark:bg-amber-900/20 dark:text-amber-300 dark:hover:bg-amber-900/30 rounded-lg transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View Project
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Most Viewed Projects Section -->
        <section class="py-16">
            <div class="text-center mb-12">
                <div class="inline-flex items-center px-4 py-2 bg-green-50 text-green-700 dark:bg-green-900/20 dark:text-green-400 rounded-full text-sm font-medium mb-4">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Most Viewed
                </div>
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Most Viewed Projects</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">The most popular projects in our community</p>
            </div>
            
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($mostViewedProjects as $project)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <!-- Most Viewed Badge -->
                        <div class="absolute top-3 right-3 z-10">
                            <span class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-400 text-xs font-medium rounded-lg">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ number_format($project->view_count) }}
                            </span>
                        </div>
                        
                        @if($project->getFirstMediaUrl('images'))
                            <div class="h-48 bg-green-100 dark:bg-green-900/20 relative">
                                <img src='{{ $project->getFirstMediaUrl('images') }}' alt="{{ $project->title }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="h-48 bg-green-100 dark:bg-green-900/20 flex items-center justify-center">
                                <svg class="w-16 h-16 text-green-600/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        @endif
                        
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">{{ $project->description }}</p>
                            
                            <div class="mb-4 flex flex-wrap gap-2">
                                @foreach($project->tags as $tag)
                                    <span class="inline-block bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200 text-xs font-medium px-3 py-1 rounded-full">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col gap-1">
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        by {{ $project->user->name }}
                                    </div>
                                    <div class="flex items-center text-sm text-gray-400 dark:text-gray-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        {{ number_format($project->view_count) }} views
                                    </div>
                                </div>
                                <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-green-700 bg-green-50 hover:bg-green-100 dark:bg-green-900/20 dark:text-green-300 dark:hover:bg-green-900/30 rounded-lg transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    View Project
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Priority Projects Section -->
        @if($priorityProjects->isNotEmpty())
            <section class="py-16 bg-green-50/50 dark:bg-gray-800/50 -mx-4">
                <div class="px-4">
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-full text-sm font-semibold mb-4">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732L14.146 12.8l-1.179 4.456a1 1 0 01-1.934 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732L9.854 7.2l1.179-4.456A1 1 0 0112 2z" clip-rule="evenodd"></path>
                            </svg>
                            Premium Projects
                        </div>
                        <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Premium Showcase</h2>
                        <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Exclusive projects from our premium community members</p>
                    </div>
                    
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                        @foreach($priorityProjects as $project)
                            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden border border-green-200 dark:border-green-700/50">
                                <!-- Premium Badge -->
                                <div class="absolute top-3 right-3 z-10">
                                    <span class="inline-flex items-center px-2 py-1 bg-green-600 text-white text-xs font-bold rounded-lg">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732L14.146 12.8l-1.179 4.456a1 1 0 01-1.934 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732L9.854 7.2l1.179-4.456A1 1 0 0112 2z" clip-rule="evenodd"></path>
                                        </svg>
                                        PRO
                                    </span>
                                </div>
                                
                                @if($project->getFirstMediaUrl('images'))
                                    <div class="h-48 bg-green-100 dark:bg-green-900/20 relative overflow-hidden">
                                        <img src='{{ $project->getFirstMediaUrl('images') }}' alt="{{ $project->title }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="h-48 bg-green-100 dark:bg-green-900/20 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-green-600/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">
                                        <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-3 line-clamp-2">{{ $project->description }}</p>
                                    
                                    <div class="mb-3 flex flex-wrap gap-1">
                                        @foreach($project->tags->take(2) as $tag)
                                            <span class="inline-block bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200 text-xs font-semibold px-2 py-0.5 rounded-full">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                        @if($project->tags->count() > 2)
                                            <span class="inline-block bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 text-xs px-2 py-0.5 rounded-full">
                                                +{{ $project->tags->count() - 2 }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex flex-col gap-1">
                                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                {{ $project->user->name }}
                                            </div>
                                            <div class="flex items-center text-xs text-gray-400 dark:text-gray-500">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                                {{ number_format($project->view_count) }} views
                                            </div>
                                        </div>
                                        <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg transition-colors duration-200">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Popular Tags Section -->
        @if($popularTags->isNotEmpty())
            <section class="py-16 bg-gray-50 dark:bg-gray-800/50 -mx-4">
                <div class="px-4">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Browse by Technology</h2>
                        <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Quick access to popular project categories</p>
                    </div>
                    
                    <div class="max-w-6xl mx-auto">
                        <div class="flex flex-wrap gap-2 justify-center">
                            @foreach($popularTags as $tag)
                                <span class="inline-block bg-white dark:bg-gray-700 hover:bg-green-50 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:border-green-300 dark:hover:border-green-500 text-sm px-3 py-1.5 rounded-full cursor-pointer transition-colors duration-200">
                                    {{ $tag->name }}
                                    <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">({{ $tag->taggables_count }})</span>
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- All Tags Section -->
        <section class="py-16 bg-gray-50 dark:bg-gray-800/50 -mx-4">
            <div class="px-4">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">All Technologies & Topics</h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Comprehensive list of all tags used in our projects</p>
                </div>
                
                <div class="max-w-6xl mx-auto">
                    <div class="flex flex-wrap gap-2 justify-center">
                        @foreach($allTags as $tag)
                            <span class="inline-block bg-white dark:bg-gray-700 hover:bg-green-50 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 hover:border-green-300 dark:hover:border-green-500 text-sm px-3 py-1.5 rounded-full cursor-pointer transition-colors duration-200">
                                {{ $tag->name }}
                                <span class="ml-1 text-xs text-gray-500 dark:text-gray-400">({{ $tag->taggables_count }})</span>
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Regular Projects Section -->
        <section class="py-16">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">All Projects</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">Browse through our complete collection of community projects</p>
            </div>
            
            @if($projects->isNotEmpty())
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($projects as $project)
                        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden border border-gray-200 dark:border-gray-700">
                            @if($project->getFirstMediaUrl('images'))
                                <div class="h-48 bg-green-100 dark:bg-green-900/20 relative overflow-hidden">
                                    <img src='{{ $project->getFirstMediaUrl('images') }}' alt="{{ $project->title }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="h-48 bg-green-100 dark:bg-green-900/20 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-green-600/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3 line-clamp-2">
                                    <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">{{ $project->description }}</p>
                                
                                <div class="mb-4 flex flex-wrap gap-2">
                                    @foreach($project->tags as $tag)
                                        <span class="inline-block bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200 text-xs font-semibold px-2 py-0.5 rounded-full">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            by {{ $project->user->name }}
                                        </div>
                                        <div class="flex items-center text-sm text-gray-400 dark:text-gray-500">
                                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            {{ number_format($project->view_count) }} views
                                        </div>
                                    </div>
                                    <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-green-700 bg-green-50 hover:bg-green-100 dark:bg-green-900/20 dark:text-green-300 dark:hover:bg-green-900/30 rounded-lg transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        View Project
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $projects->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-20 h-20 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <h3 class="text-2xl font-medium text-gray-900 dark:text-white mb-3">No projects available</h3>
                    <p class="text-gray-500 dark:text-gray-400 text-lg">Check back later for amazing new projects from our community!</p>
                </div>
            @endif
        </section>
    </div>
</div>
