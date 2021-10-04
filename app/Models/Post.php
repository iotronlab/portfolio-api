<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Post extends Model
{
    use HasFactory, AsSource;
    protected $fillable = [
        'name',
        'content',
        'meta',
        'external_url',
        'video_url',
        'status',
        'order',
    ];

    protected $casts = [
        'external_url' => 'array',
        'video_url' => 'array'
    ];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
