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
    
    public ?int $editingCommentId = null;
    #[Rule('min:5')]
    public string $editBody = '';
    
    public ?int $confirmingDeleteId = null;

    public function save()
    {
        $this->validate();

       $this->project->comments()->create([
        'body' => $this->body,
        'user_id' => Auth::id()
       ]);
       
       $this->reset('body');
    }

    public function editComment($commentId)
    {
        $comment = Comment::find($commentId);

        $this->editingCommentId = $commentId;
        $this->editBody = $comment->body;
    }

    public function updateComment()
    {
        $this->validate();
        
        $comment = Comment::find($this->editingCommentId);

        $comment->update([
            'body' => $this->editBody
        ]);

        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->editingCommentId = null;
        $this->editBody = '';
    }

    public function confirmDelete($commentId)
    {
        $this->confirmingDeleteId = $commentId;
    }

    public function destroy()
    {
        $comment = Comment::where('id', $this->confirmingDeleteId)
            ->where('user_id', Auth::id())
            ->first();
            
        if ($comment) {
            $comment->delete();
        }
        
        $this->confirmingDeleteId = null;
    }

    public function render()
    {
        $comments = $this->project->comments()->with('user')->latest()->get();
        return view('livewire.comments.comment-manage', compact('comments'));
    }
}
