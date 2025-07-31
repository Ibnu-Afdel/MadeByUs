<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Project extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasSlug;
    use HasTags;
    protected $guarded = [];

    protected $casts = [
        'status' => ProjectStatus::class,
    ];

    // protected static function booted()
    // {
    //    static::bootHasSlug();
    // }

    public function getRouteKeyName()
    {
        return 'slug';
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
