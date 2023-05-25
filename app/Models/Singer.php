<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_singer',
        'image_singer',
      ];
      public function songs()
      {
        $this -> belongsToMany(Song::class(),'singer_songs','song_id','singer_id');

      }

}
