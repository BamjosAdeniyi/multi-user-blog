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
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // This treat published_at  as a datetime object rather than an ordinary string
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }


    // An helper method for published_at
    public function isPublished(): bool
    {
        return $this->published_at !== null;
    }
}

