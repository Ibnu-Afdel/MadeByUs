<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Livewire\Attributes\On;
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
    public $image;
    public ?int $confirmingDeleteId = null;


    public function save()
    {
        if (!Auth::check()) {
            return;
        }

        $validated = $this->validate();
        $projectData = collect($validated)->except('image')->toArray();

        if ($this->editingProject) {
            $this->editingProject->update($validated);
        } else {
         $post = Auth::user()->projects()->create($projectData);
         if ($this->image) {
            $post->addMedia($this->image->getRealPath())
            ->usingFileName($this->image->getClientOriginalName())
            ->toMediaCollection('images');
         }
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

        $this->showFormModal = true;
    }

    public function closeModal()
    {
        $this->reset();
    }

    #[On('open-edit-modal')]
    public function triggerOpenEditModal(Project $project)
    {
        if ($project) {
            $this->openEditModal($project);
        }
    }

    public function destroy(Project $project)
    {
        $project->where('id', $this->confirmingDeleteId)
            ->where('user_id', FacadesAuth::user()->id)
            ->delete();
            $this->confirmingDeleteId = null;
    }

    public function confirmDelete(Project $project)
    {
        $this->confirmingDeleteId = $project->id;
    }

    public function render()
    {
        return view('livewire.projects.manage', [
            'projects' => Auth::check() ? Auth::user()->projects()->latest()->get() : collect()
        ]);
    }
}
