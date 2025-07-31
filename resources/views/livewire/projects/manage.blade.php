<div>
    <button class="border border-green-400 py-2 px-3 rounded hover:bg-green-400/10 hover:cursor-pointer"
        wire:click="openCreateModal">
        Create
    </button>

    <div class="mt-3">
        <input type="text" wire:model.live.debounce.1000ms="search" placeholder="Search projects..."
            class="border py-2 px-4 rounded">
    </div>

    @include('livewire.projects.components.modal')
    @include('livewire.projects.components.project-list')

</div>