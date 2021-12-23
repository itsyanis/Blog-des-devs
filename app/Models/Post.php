<?php

namespace App\Models;

use App\Casts\JsonCast;
use App\Casts\SafeCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'tags',
        'content',
        'image',
        'is_published'
    ];

    protected $casts = [
        'title' => SafeCast::class,
        'subtitle' => SafeCast::class,
        'tags' => JsonCast::class,
        'image' => SafeCast::class,
        'is_published' => SafeCast::class,
        'created_at' => 'datetime:Y-m-d',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
