<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Tags\HasTags;

class Project extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use HasTags;
    use InteractsWithMedia;

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

    public function getPrimaryImageUrlAttribute(): ?string
    {
        $url = $this->getFirstMediaUrl('images');

        if (! $url) {
            return null;
        }

        $components = parse_url($url);

        if ($components === false) {
            return $url;
        }

        $path = $components['path'] ?? '';

        if (! empty($components['query'])) {
            $path .= '?'.$components['query'];
        }

        if (! empty($components['fragment'])) {
            $path .= '#'.$components['fragment'];
        }

        return $path ?: $url;
    }
}
