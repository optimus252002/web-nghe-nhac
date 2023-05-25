<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    protected $fillable = ([
        'id','name_singer', 'name_song', 'path', 'lyric', 'image_song', 'name_category','action'
    ]);
}
