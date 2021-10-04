<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Portfolio extends Model
{
    use HasFactory, AsSource;
    protected $fillable = [
        'name',
        'url',
        'client_brief',
        'client_location',
        'project_description',
        'tools',
        'external_url',
        'services',
        'meta',
        'status',
        'order',
    ];

    protected $casts = [
        'tools' => 'array',
        'external_url' => 'array',
        'services' => 'array',
    ];


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
