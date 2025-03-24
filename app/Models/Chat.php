<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $table = 'chats';

    protected $fillable = [
       'user_id', 'sender', 'message', 'receiver_id', 'created_at', 'updated_at'
    ];

    function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
