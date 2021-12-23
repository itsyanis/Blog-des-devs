<?php

namespace App\Models;

use App\Models\Post;
use App\Casts\SafeCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['author_name', 'content'];

    protected $casts = [
       'author_name' => SafeCast::class,
       'content' => SafeCast::class,
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
