<?php

namespace App\Models;

use App\Models\Post;
use App\Casts\SafeCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'name'];

    protected $casts = [
        'name' => SafeCast::class,
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
