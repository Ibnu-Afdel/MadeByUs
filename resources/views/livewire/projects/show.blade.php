<div class="min-h-screen bg-gradient-to-br from-gray-50 to-green-50/30 dark:from-gray-900 dark:to-gray-800">
    <div class="container mx-auto px-4 py-8">

        <div class="mb-6">
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-600 hover:text-green-600 dark:text-gray-400 dark:hover:text-green-400 transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Projects
            </a>
        </div>

        <div class="max-w-5xl mx-auto">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700 mb-8">

                <div class="relative h-80 md:h-96">
                    @if($project->getFirstMediaUrl('images'))
                        <img src="{{ $project->getFirstMediaUrl('images') }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
                    @else
                        <div class="h-full w-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                            <svg class="w-32 h-32 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                    @endif

                    <div class="absolute top-6 left-6 flex gap-2">
                        @if($project->is_featured)
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-amber-500 text-white shadow-lg">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                FEATURED
                            </span>
                        @endif
                        
                        @if($project->is_priority)
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-bold bg-green-600 text-white shadow-lg">
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732L14.146 12.8l-1.179 4.456a1 1 0 01-1.934 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732L9.854 7.2l1.179-4.456A1 1 0 0112 2z" clip-rule="evenodd"></path>
                                </svg>
                                PRO
                            </span>
                        @endif
                    </div>

                    <div class="absolute top-6 right-6">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium @if($project->status->value === 'approved') bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200 @else bg-yellow-100 text-yellow-800 dark:bg-yellow-900/50 dark:text-yellow-200 @endif shadow-lg backdrop-blur-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                @if($project->status->value === 'approved')
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                @else
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                @endif
                            </svg>
                            {{ ucfirst($project->status->value) }}
                        </span>
                    </div>

                    @if($project->view_count > 0)
                        <div class="absolute bottom-6 right-6">
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-black/50 text-white shadow-lg backdrop-blur-sm">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ number_format($project->view_count) }} views
                            </span>
                        </div>
                    @endif
                </div>

                <!-- Content Section -->
                <div class="p-8 md:p-10">

                    <div class="mb-8">
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-4 leading-tight">{{ $project->title }}</h1>
                        <div class="flex items-center text-gray-600 dark:text-gray-400">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="text-lg font-medium">Created by {{ $project->user->name }}</span>
                            </div>
                            <span class="mx-3 text-gray-400">•</span>
                            <span class="text-lg">{{ $project->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>

                    @if($project->tags->isNotEmpty())
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Technologies Used</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($project->tags as $tag)
                                    <a href="{{ route('home', ['tag' => $tag->name]) }}" class="inline-block bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200 text-sm font-medium px-4 py-2 rounded-full hover:bg-green-200 dark:hover:bg-green-900/70 transition-colors duration-200 cursor-pointer">
                                        {{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    

                    <div class="mb-10">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">About This Project</h3>
                        <div class="prose prose-lg prose-gray dark:prose-invert max-w-none">
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg">{{ $project->description }}</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        @auth
                            @if(auth()->user()->id === $project->user_id)

                                <button wire:click='triggerEdit' class="inline-flex items-center justify-center px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit Project
                                </button>
                                
                                <a href="{{ route('projects.manage') }}" class="inline-flex items-center justify-center px-8 py-4 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white font-semibold rounded-xl hover:bg-gray-100 dark:hover:bg-gray-700 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 border-2 border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    Manage Projects
                                </a>
                            @else

                                <button class="inline-flex items-center justify-center px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    Like Project
                                </button>
                            @endif
                        @endauth
                    </div>
                    
                </div>
            </div>

            <!-- Related Projects Section -->
            @if($project->tags->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Related Projects</h3>
                        <a href="{{ route('home', ['tag' => $project->tags->first()->name]) }}" class="text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 font-medium text-sm hover:underline">
                            View all {{ $project->tags->first()->name }} projects →
                        </a>
                    </div>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Discover more projects using similar technologies</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($project->tags->take(3) as $tag)
                            <a href="{{ route('home', ['tag' => $tag->name]) }}" class="group block p-4 rounded-xl border border-gray-200 dark:border-gray-700 hover:border-green-300 dark:hover:border-green-600 hover:bg-green-50 dark:hover:bg-green-900/10 transition-all duration-200">
                                <div class="flex items-center">
                                    <div class="flex items-center justify-center w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg group-hover:bg-green-200 dark:group-hover:bg-green-900/50 transition-colors duration-200">
                                        <span class="text-green-600 dark:text-green-400 font-bold text-sm">{{ strtoupper(substr($tag->name, 0, 2)) }}</span>
                                    </div>
                                    <div class="ml-3 flex-1">
                                        <p class="font-medium text-gray-900 dark:text-white group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">{{ $tag->name }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Explore projects</p>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
            <livewire:comments.comment-manage :project="$project" />
        </div>
    </div>
</div>
