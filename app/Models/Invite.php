<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $table = 'invite';
    protected $fillable = [
        'user_id',
        'event_id',
        'user_invite',
        'statusResponse',
    ];

    protected $attributes = [
        'statusResponse' => false,
    ];
}
