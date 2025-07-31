<div class="grid gap-6 mt-6">
  @foreach ($projects as $project)
    <div
    class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100 dark:border-gray-700">
    @if($project->getFirstMediaUrl('images'))
    <div class="h-48 bg-gradient-to-br from-green-400 to-green-600 relative overflow-hidden">
      <img src="{{ $project->getFirstMediaUrl('images') }}" alt="{{ $project->title }}"
      class="w-full h-full object-cover">
      <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
    </div>
    @else
    <div class="h-48 bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
      <svg class="w-16 h-16 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
      </path>
      </svg>
    </div>
    @endif

    <div class="p-6">
      <div class="flex items-start justify-between mb-3">
      <h3 class="text-xl font-semibold text-gray-900 dark:text-white line-clamp-2">
        {{ $project->title }}
      </h3>
      <span
        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 ml-2 flex-shrink-0">
        {{  ($project->status) }}
      </span>
      </div>

      <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
      {{ $project->description }}
      </p>

      <div class="flex items-center justify-between">
      <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
        by {{ $project->user->name }}
      </div>

      <div class="flex items-center space-x-2">
        <a href="{{ route('projects.show', $project) }}"
        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-green-700 bg-green-50 hover:bg-green-100 dark:bg-green-900/20 dark:text-green-300 dark:hover:bg-green-900/30 rounded-lg transition-colors duration-200">
        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
          </path>
        </svg>
        View
        </a>

        <button wire:click="openEditModal({{ $project->id }})"
        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-gray-700 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 rounded-lg transition-colors duration-200 hover:cursor-pointer">
        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
          </path>
        </svg>
        Edit
        </button>
        <button wire:click="confirmDelete({{ $project->id }})"
        class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:outline-none rounded-lg transition-colors duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24"
          stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>

        Delete
        </button>

        @include('livewire.projects.components.delete-confirmation-modal')
      </div>
      </div>
    </div>
    </div>
  @endforeach

  @if($projects->isEmpty())
    <div class="text-center py-12">
    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
      </path>
    </svg>
    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No projects yet</h3>
    <p class="text-gray-500 dark:text-gray-400">Create your first project to get started.</p>
    </div>
  @endif
</div>