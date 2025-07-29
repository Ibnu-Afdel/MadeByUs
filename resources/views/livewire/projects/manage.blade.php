<div>
    <button class="border border-green-400 py-2 px-3 rounded hover:bg-green-400/10 hover:cursor-pointer"
        wire:click="openCreateModal">
        Create
    </button>

    @include('livewire.projects.components.modal')
    @include('livewire.projects.components.project-list')

</div>