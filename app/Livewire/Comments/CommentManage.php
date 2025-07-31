<?php

namespace App\Livewire\Comments;

use App\Models\Comment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CommentManage extends Component
{
    public Project $project;
    #[Rule('min:5')]
    public string $body = '';

    public function save()
    {
        $this->validate();

       $this->project->comments()->create([
        'body' => $this->body,
        'user_id' => Auth::id()
       ]);
       $this->reset('body');
    }
    public function render()
    {
        $comments = $this->project->comments()->latest()->get();
        return view('livewire.comments.comment-manage', compact('comments'));
    }
}
