<?php

namespace App\Livewire\Public;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]

class Index extends Component
{
    public function render()
    {
        return view('livewire.public.index');
    }
}
