<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'published_at',
    ];
    
    public fucntion post(): BelongsTo
    {
        return $this->belongsTo(User:class);
    }
}

