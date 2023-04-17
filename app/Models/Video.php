<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'embed_code'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'tags_videos', 'tags_id', 'videos_id');
    }
}
