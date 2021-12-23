<?php

namespace App\Models;

use App\Casts\SafeCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phoneNumber',
        'subject',
        'message',
    ];

    protected $casts = [
        'first_name' => SafeCast::class,
        'last_name' => SafeCast::class,
        'email' => SafeCast::class,
        'phoneNumber' => SafeCast::class,
        'subject' => SafeCast::class,
        'message' => SafeCast::class,
    ];
}
