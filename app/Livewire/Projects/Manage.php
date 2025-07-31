<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Tags\Tag;

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
    public string|null $existingImageUrl = null;
    #[Rule('required')]
    public string $tags = '';

    public string $search = '';


    public function save()
    {
        if (!Auth::check()) {
            return;
        }

        $validated = $this->validate();
        $projectData = collect($validated)->except(['image', 'tags'])->toArray();

        if (Auth::user()->hasRole('Premium')) {
            $projectData['is_priority'] = true;
        }

        if ($this->editingProject) {
            $this->updateProject($projectData);
        } else {
            $this->createProject($projectData);
        }
        $this->closeModal();
    }
    public function createProject($projectData)
    {
        $project = Auth::user()->projects()->create($projectData);

        if ($this->image) {
            $project->addMedia($this->image->getRealPath())
                ->usingFileName($this->image->getClientOriginalName())
                ->toMediaCollection('images');
        }

        $tags = collect(explode(',', $this->tags))
            ->map(fn($tag) => trim($tag))
            ->filter(fn($tag) => !empty($tag))  
            ->unique()
            ->toArray();

        $project->syncTags($tags);
    }

    public function updateProject($projectData)
    {
        $this->editingProject->update($projectData);
        if ($this->image) {
            $this->editingProject
                ->clearMediaCollection('images')
                ->addMedia($this->image->getRealPath())
                ->usingFileName($this->image->getClientOriginalName())
                ->toMediaCollection('images');
        }

         $tags = collect(explode(',', $this->tags))
            ->map(fn($tag) => trim($tag))
            ->filter(fn($tag) => !empty($tag))  
            ->unique()
            ->toArray();

        $this->editingProject->syncTags($tags);
    }

    public function openCreateModal()
    {
        $this->reset();
        $this->showFormModal = true;
    }

    public function openEditModal($projectId)
    {
        $project = Project::findOrFail($projectId);
        $this->editingProject = $project;
        $this->title = $project->title;
        $this->description = $project->description;
        $this->existingImageUrl = $project->getFirstMediaUrl('images');
        $this->tags = $project->tags()->pluck('name')->implode(',');

        $this->showFormModal = true;
    }

    public function closeModal()
    {
        $this->reset();
    }

    #[On('open-edit-modal')]
    public function triggerOpenEditModal($projectId)
    {
        if ($projectId) {
            $this->openEditModal($projectId);
        }
    }

    public function destroy()
    {
        $project = Project::where('id', $this->confirmingDeleteId)
            ->where('user_id', Auth::id())
            ->first();
        if ($project) {
            $project->delete();
        }
        $this->confirmingDeleteId = null;
    }

    public function confirmDelete($projectId)
    {
        $this->confirmingDeleteId = $projectId;
    }

    public function render()
    {
        $projects = Auth::check() 
        ? Auth::user()
        ->projects()
        ->when($this->search, function($query){
            $query->where('title', 'like', "%{$this->search}%")
            ->orWhereHas('tags', function($query){
                $query->where('name->en', 'like', "%{$this->search}%");
            });
        })
        ->latest()
        ->get() 
        : collect();
        
        return view('livewire.projects.manage', compact('projects'));
    }
}
