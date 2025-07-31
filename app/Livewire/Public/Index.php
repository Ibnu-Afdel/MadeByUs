<?php

namespace App\Livewire\Public;

use App\Models\Project;
use Spatie\Tags\Tag;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.guest')]

class Index extends Component
{
    use WithPagination;
    
    public string $search = '';
    public function render()
    {
        
        $featuredProjects = Project::where('status', 'approved')
            ->where('is_featured', true)
            ->when($this->search, function($query) {
                $query->where(function($subQuery) {
                    $subQuery->where('title', 'like', "%{$this->search}%")
                             ->orWhereHas('tags', function($tagQuery) {
                                 $tagQuery->where('name->en', 'like', "%{$this->search}%");
                             });
                });
            })
            ->latest()
            ->take(3)
            ->get();

        
        $priorityProjects = Project::where('status', 'approved')
            ->where('is_priority', true)
            ->where('is_featured', false) 
            ->when($this->search, function($query) {
                $query->where(function($subQuery) {
                    $subQuery->where('title', 'like', "%{$this->search}%")
                             ->orWhereHas('tags', function($tagQuery) {
                                 $tagQuery->where('name->en', 'like', "%{$this->search}%");
                             });
                });
            })
            ->inRandomOrder()
            ->take(4)
            ->get();

        $mostViewedProjects = Project::where('status', 'approved')
            ->where('is_featured', false)
            ->where('is_priority', false)
            ->when($this->search, function($query) {
                $query->where(function($subQuery) {
                    $subQuery->where('title', 'like', "%{$this->search}%")
                             ->orWhereHas('tags', function($tagQuery) {
                                 $tagQuery->where('name->en', 'like', "%{$this->search}%");
                             });
                });
            })
            ->latest()
            ->take(6)
            ->get();

        $projects = Project::where('status', 'approved')
            ->where('is_featured', false)
            ->where('is_priority', false)
            ->when($this->search, function($query) {
                $query->where(function($subQuery) {
                    $subQuery->where('title', 'like', "%{$this->search}%")
                             ->orWhereHas('tags', function($tagQuery) {
                                 $tagQuery->where('name->en', 'like', "%{$this->search}%");
                             });
                });
            })
            ->latest()
            ->paginate(6);

        // Popular Tags (using raw query to count taggables)
        $popularTags = Tag::selectRaw('tags.*, COUNT(taggables.tag_id) as taggables_count')
            ->leftJoin('taggables', 'tags.id', '=', 'taggables.tag_id')
            ->groupBy('tags.id')
            ->orderBy('taggables_count', 'desc')
            ->take(8)
            ->get();

        // All Tags (for comprehensive display)
        $allTags = Tag::selectRaw('tags.*, COUNT(taggables.tag_id) as taggables_count')
            ->leftJoin('taggables', 'tags.id', '=', 'taggables.tag_id')
            ->groupBy('tags.id')
            ->orderBy('taggables_count', 'desc')
            ->get();

        return view('livewire.public.index', compact(
            'featuredProjects', 
            'priorityProjects', 
            'mostViewedProjects',
            'projects', 
            'popularTags',
            'allTags'
        ));
    }
}
