<?php

namespace App\Livewire\Public;

use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]

class Index extends Component
{
    public function render()
    {
        $projects = Project::where('status', 'accepted')->latest()->get();
        return view('livewire.public.index', compact('projects'));
    }
}
