<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Manage extends Component
{
    use WithFileUploads;
    public bool $showFormModal = false;
    public ?Project $editingProject = null;

    #[Rule('required|min:3')]
    public string $title = '';

    #[Rule('required')]
    public string $description = '';

    #[Rule('nullable|image|max:1024')]
    public $image ;


    public function save()
    {
        if (!Auth::check()) {
            return;
        }

        $validated = $this->validate();

        if ($this->editingProject){
            $this->editingProject->update($validated);
        }else {
            Auth::user()->projects()->create($validated);
        }
        $this->closeModal();
    }

    public function openCreateModal()
    {
        $this->reset();
        $this->showFormModal = true;
    }

    public function openEditModal(Project $project)
    {
        $this->editingProject = $project;
        $this->title = $project->title;
        $this->description = $project->description;

        $this->showFormModal= true;
    }

    public function closeModal()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.projects.manage', [
            'projects' => Auth::check() ? Auth::user()->projects()->latest()->get() : collect()
        ]);
    }
}
