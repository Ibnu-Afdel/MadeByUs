<?php

namespace App\Livewire\Public;

use App\Models\Project;
use Spatie\Tags\Tag;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.guest')]

class Index extends Component
{
    use WithPagination;
    
    #[Url(as: 'search')]
    public string $search = '';
    
    #[Url(as: 'tag')]
    public ?string $selectedTag = null;
    
    public function filterByTag(?string $tagName)
    {
        if ($tagName) {
            // Handle URL encoding: decode %20, +, and other encodings
            $decoded = urldecode($tagName);
            // Trim any remaining whitespace
            $this->selectedTag = trim($decoded);
        } else {
            $this->selectedTag = null;
        }
        $this->resetPage(); // Reset pagination when filtering
    }
    
    public function clearFilters()
    {
        $this->selectedTag = null;
        $this->search = '';
        $this->resetPage();
    }
    
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
            ->when($this->selectedTag, function($query) {
                $query->whereHas('tags', function($tagQuery) {
                    // Use LIKE with wildcards to handle whitespace in JSON
                    $tagQuery->where('name->en', 'like', "%{$this->selectedTag}%");
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
            ->when($this->selectedTag, function($query) {
                $query->whereHas('tags', function($tagQuery) {
                    // Use LIKE with wildcards to handle whitespace in JSON
                    $tagQuery->where('name->en', 'like', "%{$this->selectedTag}%");
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
            ->when($this->selectedTag, function($query) {
                $query->whereHas('tags', function($tagQuery) {
                    // Use LIKE with wildcards to handle whitespace in JSON
                    $tagQuery->where('name->en', 'like', "%{$this->selectedTag}%");
                });
            })
            ->orderBy('view_count', 'desc')
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
            ->when($this->selectedTag, function($query) {
                $query->whereHas('tags', function($tagQuery) {
                    // Use LIKE with wildcards to handle whitespace in JSON
                    $tagQuery->where('name->en', 'like', "%{$this->selectedTag}%");
                });
            })
            ->latest()
            ->paginate(6);

        // Popular Tags (only tags used by approved projects)
        $popularTags = Tag::selectRaw('tags.*, COUNT(DISTINCT projects.id) as taggables_count')
            ->join('taggables', 'tags.id', '=', 'taggables.tag_id')
            ->join('projects', function($join) {
                $join->on('taggables.taggable_id', '=', 'projects.id')
                     ->where('taggables.taggable_type', '=', 'App\Models\Project');
            })
            ->where('projects.status', 'approved')
            ->groupBy('tags.id', 'tags.name', 'tags.slug', 'tags.type', 'tags.order_column', 'tags.created_at', 'tags.updated_at')
            ->having('taggables_count', '>', 0)
            ->orderBy('taggables_count', 'desc')
            ->take(8)
            ->get();

        // All Tags (only tags used by approved projects)
        $allTags = Tag::selectRaw('tags.*, COUNT(DISTINCT projects.id) as taggables_count')
            ->join('taggables', 'tags.id', '=', 'taggables.tag_id')
            ->join('projects', function($join) {
                $join->on('taggables.taggable_id', '=', 'projects.id')
                     ->where('taggables.taggable_type', '=', 'App\Models\Project');
            })
            ->where('projects.status', 'approved')
            ->groupBy('tags.id', 'tags.name', 'tags.slug', 'tags.type', 'tags.order_column', 'tags.created_at', 'tags.updated_at')
            ->having('taggables_count', '>', 0)
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
