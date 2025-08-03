<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Show extends Component
{
    public Project $project;

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->project->increment('view_count');
    }

    public function triggerEdit()
    {
        $this->dispatch('open-edit-modal', $this->project->id);
    }

    public function render()
    {
        return view('livewire.projects.show');
    }
}
