<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'sender_id', 'recipient_id', 'content',
        'created_at', 'updated_at'
    ];
}