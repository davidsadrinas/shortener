<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class URLShorten extends Model
{
    use HasFactory;

    protected $table = 'url_shorten';

    protected $fillable = [
        'url',
    ];
}
