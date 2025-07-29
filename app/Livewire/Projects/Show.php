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
        // auth wbe here
        
    }

    public function triggerEdit()
    {
        $this->dispatch('open-edit-modal', $this->project);
    }

    public function render()
    {
        return view('livewire.projects.show');
    }
}
