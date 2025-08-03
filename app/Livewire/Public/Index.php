<?php

namespace App\Livewire\Public;

use App\Models\Project;
use Spatie\Tags\Tag;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('components.layouts.guest')]

class Index extends Component
{
    #[Url(as: 'search')]
    public string $search = '';
    
    #[Url(as: 'tag')]
    public ?string $selectedTag = null;
    
    public int $perPage = 6;
    public bool $hasMorePages = true;
    
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
        $this->resetProjects();
    }
    
    public function clearFilters()
    {
        $this->selectedTag = null;
        $this->search = '';
        $this->resetProjects();
    }
    
    public function loadMore()
    {
        $this->perPage += 6;
    }
    
    private function resetProjects()
    {
        $this->perPage = 6;
        $this->hasMorePages = true;
    }
    
    public function updatedSearch()
    {
        $this->resetProjects();
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

        $projectsQuery = Project::where('status', 'approved')
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
            ->latest();

        $projects = $projectsQuery->take($this->perPage)->get();
        
        // Check if there are more projects to load
        $totalProjects = $projectsQuery->count();
        $this->hasMorePages = $totalProjects > $this->perPage;

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
