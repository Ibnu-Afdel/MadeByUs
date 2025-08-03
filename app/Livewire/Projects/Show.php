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
        $viewKey = 'viewed_project_' . $project->id;
        if (!session()->has($viewKey)) {
            $this->project->increment('view_count');
            session()->put($viewKey, true);
        }
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
