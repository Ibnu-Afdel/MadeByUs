<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function comments()
    {
        $this->hasMany(Comment::class);
    }
}
