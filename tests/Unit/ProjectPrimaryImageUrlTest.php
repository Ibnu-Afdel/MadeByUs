<?php

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('returns a relative url for the primary image', function () {
    config(['filesystems.disks.public.url' => 'http://example.com/storage']);
    Storage::fake('public');

    $project = Project::factory()->create();

    $file = UploadedFile::fake()->image('cover.jpg');
    $project->addMedia($file)->toMediaCollection('images');

    config(['app.url' => 'http://example.com']);

    $absoluteUrl = $project->getFirstMediaUrl('images');

    expect($project->primary_image_url)->toBe(parse_url($absoluteUrl, PHP_URL_PATH));
});
