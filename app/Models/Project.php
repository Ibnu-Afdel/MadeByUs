<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use InteractsWithMedia;
    protected $guarded = [];

    protected $casts = [
        'status' => ProjectStatus::class,
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    protected static function booted()
    {
        static::creating(function (Project $project) {
            // $project->slug = Str::slug($project->title);
            $project->slug = static::generateUniqueSlug($project->title);
        });

        static::updating(function (Project $project) {
            if ($project->isDirty('title')) {
                // $project->slug = Str::slug($project->title);
                $project->slug = static::generateUniqueSlug($project->title, $project->id);
            }
        });
    }

    protected static function generateUniqueSlug($title, $ignoredId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while(static::where('slug', $slug)
            ->when($ignoredId, fn($query) => $query->where('id', '!=', $ignoredId))
        ->exists()){
            $slug = $originalSlug . '-' . $count++;
        }
        return $slug;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
