<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{

    protected static function bootHasSlug()
    {
        static::creating(function ($model) {
            // $project->slug = Str::slug($project->title);
            $model->slug = static::generateUniqueSlug($model->title);
        });

        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                // $project->slug = Str::slug($project->title);
                $model->slug = static::generateUniqueSlug($model->title, $model->id);
            }
        });
    }

    protected static function generateUniqueSlug($title, $ignoredId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (static::where('slug', $slug)
            ->when($ignoredId, fn($query) => $query->where('id', '!=', $ignoredId))
            ->exists()
        ) {
            $slug = $originalSlug . '-' . $count++;
        }
        return $slug;
    }
}
