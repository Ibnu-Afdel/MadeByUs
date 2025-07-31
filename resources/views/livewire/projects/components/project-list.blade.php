<div class="space-y-6">
    @if($projects->isNotEmpty())
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($projects as $project)
                <div class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border border-gray-200 dark:border-gray-700">
                    
                    <!-- Image Section -->
                    <div class="relative">
                        @if($project->getFirstMediaUrl('images'))
                            <div class="h-48 bg-gradient-to-br from-green-400 to-green-600 relative overflow-hidden">
                                <img src="{{ $project->getFirstMediaUrl('images') }}" alt="{{ $project->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                            </div>
                        @else
                            <div class="h-48 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                            </div>
                        @endif

                        <div class="absolute top-3 left-3 flex gap-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-lg text-xs font-medium shadow-lg backdrop-blur-sm
                                @if($project->status->value === 'approved') bg-green-100/90 text-green-800 dark:bg-green-900/80 dark:text-green-200
                                @elseif($project->status->value === 'pending') bg-yellow-100/90 text-yellow-800 dark:bg-yellow-900/80 dark:text-yellow-200
                                @else bg-red-100/90 text-red-800 dark:bg-red-900/80 dark:text-red-200 @endif">
                                @if($project->status->value === 'approved')
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                @elseif($project->status->value === 'pending')
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                @endif
                                {{ ucfirst($project->status->value) }}
                            </span>
                            
                            @if($project->is_featured)
                                <span class="inline-flex items-center px-2 py-1 bg-amber-500/90 text-white text-xs font-bold rounded-lg shadow-lg backdrop-blur-sm">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    FEATURED
                                </span>
                            @endif
                            
                            @if($project->is_priority)
                                <span class="inline-flex items-center px-2 py-1 bg-green-600/90 text-white text-xs font-bold rounded-lg shadow-lg backdrop-blur-sm">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732L14.146 12.8l-1.179 4.456a1 1 0 01-1.934 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732L9.854 7.2l1.179-4.456A1 1 0 0112 2z" clip-rule="evenodd"></path>
                                    </svg>
                                    PRO
                                </span>
                            @endif
                        </div>

                        @if($project->view_count > 0)
                            <div class="absolute top-3 right-3">
                                <span class="inline-flex items-center px-2 py-1 bg-black/50 text-white text-xs font-medium rounded-lg shadow-lg backdrop-blur-sm">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ number_format($project->view_count) }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="p-6">
                        <div class="mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors duration-200">
                                {{ $project->title }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2">
                                {{ $project->description }}
                            </p>
                        </div>

                        @if($project->tags->isNotEmpty())
                            <div class="mb-4 flex flex-wrap gap-2">
                                @foreach ($project->tags->take(3) as $tag)
                                    <span class="inline-block bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200 text-xs font-medium px-2 py-1 rounded-full">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                                @if($project->tags->count() > 3)
                                    <span class="inline-block bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded-full">
                                        +{{ $project->tags->count() - 3 }}
                                    </span>
                                @endif
                            </div>
                        @endif

                        <div class="flex items-center justify-between mb-4 text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $project->created_at->format('M j, Y') }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                {{ $project->tags->count() }} tags
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="{{ route('projects.show', $project) }}"
                                class="flex-1 inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-green-700 bg-green-50 hover:bg-green-100 dark:bg-green-900/20 dark:text-green-300 dark:hover:bg-green-900/30 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                View
                            </a>

                            <button wire:click="openEditModal({{ $project->id }})"
                                class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-700 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                            
                            <button wire:click="confirmDelete({{ $project->id }})"
                                class="inline-flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600 focus:ring-2 focus:ring-red-500 focus:outline-none rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                @include('livewire.projects.components.delete-confirmation-modal')
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-12">
            <div class="text-center">
                <div class="flex items-center justify-center w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-full mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                
                @if($search)
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No projects found</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">No projects match your search for "{{ $search }}"</p>
                    <button wire:click="$set('search', '')" 
                        class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Clear Search
                    </button>
                @else
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No projects yet</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Create your first project to get started showcasing your work</p>
                    <button wire:click="openCreateModal" 
                        class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create Your First Project
                    </button>
                @endif
            </div>
        </div>
    @endif
</div>