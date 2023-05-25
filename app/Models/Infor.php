<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infor extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'phone',
        'avatar',
    ];
    public function users()
    {
        $this -> belongsToMany(User::class(),'infor_users','user_id','infor_id');
    }
}
