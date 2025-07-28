<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function project()
    {
        $this->belongsTo(Project::class);
    }
}
