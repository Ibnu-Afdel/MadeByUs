<div>
<button wire:click='openCreateModal'>create</button>
@if ($showFormModal)
    <form  wire:submit="save" >
        <input wire:model='title' type="text" name="title" id="title" placeholder="title">
        <textarea wire:model='description' name="description" id="description"
        ></textarea>
        <button>save</button>
    </form>
@endif
</div>
