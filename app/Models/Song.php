<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_song',
        'image_song',
        'path',
        'lyric',
    ];
    public function singers()
    {
        $this -> belongsToMany(Singer::class(),'singer_songs','singer_id','song_id');
    }
    public function categories()
    {
        $this -> belongsToMany(Category::class(),'category_songs','song_id','category_id');
    }
}
