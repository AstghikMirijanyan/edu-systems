<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagsVideos extends Model
{
    use HasFactory;
    protected $fillable = [
        'tags_id', 'videos_id'
    ];
}
