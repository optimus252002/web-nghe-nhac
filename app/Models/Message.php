<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'status',
    ];
    public function users()
    {
        $this->many(User::class(),'user_messages','user_id','message_id');
    }
}
