<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    
    <!-- Simple Header -->
    <div class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 py-6">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between">
                <!-- Left: Simple sentence -->
                <div>
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Discover amazing projects from our community
                </h1>
                </div>

                <!-- Right: Search input -->
                <div class="w-96">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input 
                            type="text" 
                            wire:model.live.debounce.500ms="search" 
                            placeholder="Search projects..."
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        >
                        <div wire:loading wire:target="search" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="animate-spin h-4 w-4 text-indigo-500" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 818-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                        </div>
                    
                    <!-- Active Filters -->
                    @if($selectedTag || $search)
        <div class="bg-white/95 dark:bg-gray-900/95 backdrop-blur-sm border-b border-gray-200 dark:border-gray-700 py-4 relative z-30">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Active filters:</span>
                                @if($selectedTag)
                            <span class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-200 text-sm font-medium rounded-xl border border-blue-200 dark:border-blue-700">
                                        {{ $selectedTag }}
                                <button wire:click="filterByTag(null)" class="ml-2 hover:text-blue-900 dark:hover:text-blue-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </span>
                        @endif
                        @if($search)
                            <span class="inline-flex items-center px-3 py-2 bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-200 text-sm font-medium rounded-xl border border-emerald-200 dark:border-emerald-700">
                                "{{ $search }}"
                                <button wire:click="$set('search', '')" class="ml-2 hover:text-emerald-900 dark:hover:text-emerald-100 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                    </div>
                                <button wire:click="clearFilters" class="text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 underline transition-colors">
                                    Clear all filters
                                </button>
                            </div>
                @if($search)
                    <div class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                        Found <span class="font-semibold text-gray-900 dark:text-white">{{ $featuredProjects->count() + $priorityProjects->count() + $projects->count() + $mostViewedProjects->count() }}</span> projects
                        </div>
                    @endif
            </div>
        </div>
    @endif

    <!-- Main Layout with Sidebar -->
    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar (25%) - Shows first on mobile, only on clean homepage -->
            @if(!$selectedTag && !$search)
                <div class="lg:w-1/4 space-y-8 order-1 lg:order-2">
                
                <!-- Quick Tag Navigation in Sidebar -->
                @if($popularTags->isNotEmpty())
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Popular Tags
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($popularTags->take(15) as $tag)
                                <button wire:click="filterByTag('{{ $tag->name }}')" 
                                        class="inline-block bg-gray-100 hover:bg-indigo-100 dark:bg-gray-700 dark:hover:bg-indigo-900/50 text-gray-700 dark:text-gray-300 hover:text-indigo-700 dark:hover:text-indigo-300 text-sm px-3 py-1.5 rounded-full transition-all duration-200 hover:shadow-md
                                        {{ $selectedTag === $tag->name ? 'bg-indigo-600 text-white' : '' }}">
                                    {{ $tag->name }}
                                    <span class="ml-1 text-xs opacity-75">({{ $tag->taggables_count }})</span>
                                </button>
                            @endforeach
                        </div>
                                    </div>
                                @endif
                                
                <!-- Most Viewed Projects in Sidebar -->
                @if($mostViewedProjects->isNotEmpty())
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                            </svg>
                            Trending Projects
                                </h3>
                        <div class="space-y-4">
                            @foreach($mostViewedProjects->take(5) as $index => $project)
                                <div class="group relative bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 hover:shadow-md">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                    @if($project->primary_image_url)
                                                <img src="{{ $project->primary_image_url }}" 
                                                     alt="{{ $project->title }}" 
                                                     class="w-12 h-12 rounded-lg object-cover">
                                    @else
                                                <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-500 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                            </svg>
                                        </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200 line-clamp-2">
                                                <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                                            </h4>
                                            <div class="flex items-center justify-between mt-2">
                                                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $project->user->name }}</span>
                                                <div class="flex items-center text-xs text-green-600 dark:text-green-400">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                    </svg>
                                                    {{ number_format($project->view_count) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
            @endif

                <!-- Additional Sidebar Content - Stats -->
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-2xl p-6 border border-indigo-100 dark:border-indigo-800/50">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Community Stats</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Total Projects</span>
                            <span class="text-lg font-bold text-indigo-600 dark:text-indigo-400">{{ number_format($projects->count() + $featuredProjects->count() + $priorityProjects->count()) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Categories</span>
                            <span class="text-lg font-bold text-purple-600 dark:text-purple-400">{{ $popularTags->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Featured</span>
                            <span class="text-lg font-bold text-amber-600 dark:text-amber-400">{{ $featuredProjects->count() }}</span>
                        </div>
                    </div>
                </div>
                            </div>
            @endif
            
            <!-- Main Content (75% with sidebar, 100% without) -->
            <div class="flex-1 {{ (!$selectedTag && !$search) ? 'lg:w-3/4 order-2 lg:order-1' : 'w-full' }}">
                
                @if(!$selectedTag && !$search)
                    <!-- Featured Projects Section - Bento Grid Style -->
                    @if($featuredProjects->isNotEmpty())
                        <section class="mb-16">
                            <div class="relative">
                                <!-- Background Pattern -->
                                <div class="absolute inset-0 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/10 dark:to-orange-900/10 rounded-3xl"></div>
                                <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width="80" height="80" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23f59e0b" fill-opacity="0.05"%3E%3Cpath d="M20 20l20-20 20 20-20 20z"/%3E%3Cpath d="M0 40l20-20 20 20-20 20z"/%3E%3Cpath d="M40 40l20-20 20 20-20 20z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] rounded-3xl"></div>
                                
                                <div class="relative p-6 lg:p-8">
                                    <div class="text-center mb-8">
                                        <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 text-white text-sm font-bold rounded-full shadow-lg mb-4">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            Featured Projects
                                        </div>
                                        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Editor's Choice</h2>
                                        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Hand-picked exceptional projects from our community</p>
                                    </div>
                                    
                                    <!-- Bento Grid Layout for Featured -->
                                    <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-6 gap-4 auto-rows-[160px]">
                                        @foreach($featuredProjects as $index => $project)
                                            <div class="group relative bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-amber-200 dark:border-amber-800/50 hover:border-amber-400 dark:hover:border-amber-600 hover:scale-105
                                                {{ $index === 0 ? 'md:col-span-3 md:row-span-2' : ($index === 1 ? 'md:col-span-3 md:row-span-1' : 'md:col-span-2') }}">
                                                
                                                <!-- Featured Badge -->
                                                <div class="absolute top-3 right-3 z-10">
                                                    <span class="inline-flex items-center px-2 py-1 bg-gradient-to-r from-amber-500 to-orange-600 text-white text-xs font-bold rounded-lg shadow-lg">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                        FEATURED
                                                    </span>
                                                </div>

                                                <!-- Project Image -->
                                                <div class="h-full relative overflow-hidden">
                                                    @if($project->primary_image_url)
                                                        <img src="{{ $project->primary_image_url }}" 
                                                             alt="{{ $project->title }}" 
                                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                                        <div class="w-full h-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center">
                                                            <svg class="w-16 h-16 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                                    <!-- Overlay Content - Always visible on mobile, hover on desktop -->
                                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                                                        <h3 class="text-white font-bold {{ $index === 0 ? 'text-xl mb-2' : 'text-base mb-1' }} line-clamp-2">
                                        <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                                    </h3>
                                                        @if($index === 0)
                                                            <p class="text-gray-200 text-sm mb-3 line-clamp-2">{{ $project->description }}</p>
                                                        @endif
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center text-xs text-gray-300">
                                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($project->user->name) }}&size=20&background=f59e0b&color=ffffff" 
                                                                     alt="{{ $project->user->name }}" 
                                                                     class="w-4 h-4 rounded-full mr-2">
                                                                {{ $project->user->name }}
                                    </div>
                                                            <a href="{{ route('projects.show', $project) }}" 
                                                               class="inline-flex items-center text-xs font-medium text-white bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full transition-all duration-200">
                                                                View
                                                                <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                            </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                @endif

                <!-- Latest Projects with Light Green Theme -->
                <section class="mb-12" x-data="{ 
                    init() {
                        let observer = new IntersectionObserver((entries) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting && @js($hasMorePages)) {
                                    @this.loadMore();
                                }
                            });
                        }, { threshold: 0.1 });
                        
                        this.$nextTick(() => {
                            let target = this.$refs.loadMore;
                            if (target) observer.observe(target);
                        });
                    }
                }">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center space-x-3">
                            <div class="w-1 h-8 bg-gradient-to-b from-emerald-500 to-green-500 rounded-full"></div>
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white">
                                @if($selectedTag)
                                    Projects tagged with "{{ $selectedTag }}"
                                @elseif($search)
                                    Search Results
                                @else
                                    Latest Projects
                                @endif
                            </h2>
                    </div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $projects->count() }} projects
                        </span>
                </div>
                
                    @if($projects->isNotEmpty())
                        <!-- Masonry Grid Layout with Animations -->
                        <div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
                            @foreach($projects as $index => $project)
                                <div wire:key="project-{{ $project->id }}"
                                     x-data="{ 
                                         visible: false,
                                         init() {
                                             setTimeout(() => { 
                                                 this.visible = true 
                                             }, {{ $index * 50 }})
                                         }
                                     }"
                                     x-show="visible"
                                     x-transition:enter="transition ease-out duration-500"
                                     x-transition:enter-start="opacity-0 transform translate-y-8 scale-95"
                                     x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                                     class="break-inside-avoid group relative bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-emerald-400 dark:hover:border-emerald-600 hover:scale-[1.02]
                                     {{ $index % 4 === 0 ? 'mb-8' : ($index % 3 === 0 ? 'mb-6' : 'mb-4') }}">
                                    
                                    <!-- Project Badges -->
                                    <div class="absolute top-4 left-4 z-10 flex space-x-2">
                                    @if($project->is_featured)
                                            <span class="inline-flex items-center px-2 py-1 bg-amber-600 text-white text-xs font-medium rounded-lg shadow-lg">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            FEATURED
                                        </span>
                                        @endif
                                        @if($project->is_priority)
                                            <span class="inline-flex items-center px-2 py-1 bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold rounded-lg shadow-lg">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732L14.146 12.8l-1.179 4.456a1 1 0 01-1.934 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732L9.854 7.2l1.179-4.456A1 1 0 0112 2z" clip-rule="evenodd"></path>
                                            </svg>
                                            PRO
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- View Count Badge -->
                                @if($project->view_count > 0)
                                        <div class="absolute top-4 right-4 z-10">
                                            <span class="inline-flex items-center px-2 py-1 bg-black/50 backdrop-blur-sm text-white text-xs font-medium rounded-lg">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            {{ number_format($project->view_count) }}
                                        </span>
                                    </div>
                                @endif
                                
                                    <!-- Project Image -->
                                @if($project->primary_image_url)
                                        <div class="{{ $index % 3 === 0 ? 'h-64' : ($index % 2 === 0 ? 'h-48' : 'h-56') }} relative overflow-hidden">
                                            <img src="{{ $project->primary_image_url }}" 
                                                 alt="{{ $project->title }}" 
                                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                @else
                                        <div class="{{ $index % 3 === 0 ? 'h-64' : ($index % 2 === 0 ? 'h-48' : 'h-56') }} bg-gradient-to-br from-emerald-400 via-green-500 to-teal-500 flex items-center justify-center">
                                            <svg class="w-16 h-16 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                    <!-- Project Content -->
                                <div class="p-6">
                                        <h3 class="{{ $index % 3 === 0 ? 'text-xl' : 'text-lg' }} font-bold text-gray-900 dark:text-white mb-3 line-clamp-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-200">
                                        <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                                    </h3>
                                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 {{ $index % 3 === 0 ? 'line-clamp-4' : 'line-clamp-3' }}">{{ $project->description }}</p>
                                    
                                        <!-- Tags -->
                                    <div class="mb-4 flex flex-wrap gap-2">
                                            @foreach($project->tags->take($index % 3 === 0 ? 4 : 3) as $tag)
                                                <span wire:click="filterByTag('{{ $tag->name }}')" 
                                                      class="inline-block bg-emerald-100 text-emerald-800 dark:bg-emerald-900/50 dark:text-emerald-200 text-xs font-medium px-2 py-1 rounded-full cursor-pointer hover:bg-emerald-200 dark:hover:bg-emerald-900/70 transition-colors duration-200 
                                                      {{ $selectedTag === $tag->name ? 'bg-emerald-600 text-white' : '' }}">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                            @if($project->tags->count() > ($index % 3 === 0 ? 4 : 3))
                                                <span class="inline-block bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded-full">
                                                    +{{ $project->tags->count() - ($index % 3 === 0 ? 4 : 3) }}
                                                </span>
                                            @endif
                                    </div>
                                    
                                        <!-- Footer -->
                                    <div class="flex items-center justify-between">
                                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($project->user->name) }}&size=24&background=10b981&color=ffffff" 
                                                     alt="{{ $project->user->name }}" 
                                                     class="w-5 h-5 rounded-full mr-2">
                                                {{ $project->user->name }}
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <span class="text-xs text-gray-400 dark:text-gray-500">{{ $project->created_at->diffForHumans() }}</span>
                                                <a href="{{ route('projects.show', $project) }}" 
                                                   class="inline-flex items-center text-xs font-medium text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors duration-200">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                                </svg>
                                                </a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                        <!-- Infinite Scroll Trigger -->
                        @if($hasMorePages)
                            <div x-ref="loadMore" class="mt-12 text-center py-8">
                                <div wire:loading wire:target="loadMore" class="inline-flex items-center text-emerald-600 dark:text-emerald-400">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 818-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Loading more projects...
                                </div>
                                <div wire:loading.remove wire:target="loadMore">
                                    <button wire:click="loadMore" class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-full hover:bg-emerald-700 transition-colors duration-200 font-medium">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        Load More Projects
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="mt-12 text-center py-8">
                                <div class="text-gray-500 dark:text-gray-400 text-lg">
                                    🎉 You've seen all projects! Check back later for more amazing content.
                                </div>
                        </div>
                    @endif
                @else
                        <!-- Empty State -->
                    <div class="text-center py-16">
                            <div class="w-24 h-24 bg-gradient-to-br from-emerald-100 to-green-100 dark:from-emerald-900/20 dark:to-green-900/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                                @if($selectedTag)
                                    No projects found with "{{ $selectedTag }}"
                                @elseif($search)
                                    No projects found for "{{ $search }}"
                                @else
                                    No projects available
                                @endif
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400 text-lg mb-8 max-w-md mx-auto">
                                @if($selectedTag || $search)
                                    Try adjusting your filters or browse all projects instead.
                                @else
                                    Check back later for amazing new projects from our community!
                                @endif
                            </p>
                            @if($selectedTag || $search)
                                <button wire:click="clearFilters" class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-full hover:bg-emerald-700 transition-colors duration-200 font-medium">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            Browse All Projects
                        </button>
                            @endif
                    </div>
                @endif
            </section>
            </div>
        </div>
    </div>

    <!-- Alpine.js for infinite scroll and animations -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Custom Styles -->
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .line-clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</div>
