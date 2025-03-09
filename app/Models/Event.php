<?php

namespace App\Models;

use App\EventDomain\TypeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'id',
        'title',
        'description',
        'eventStart',
        'eventEnd',
//        'user_id',
        'status'
    ];

    protected function casts() : array
    {
        return [
          'eventStart', 'eventEnd' => 'datetime:Y-m-d H:i:s',
        ];
    }
    protected $attributes = [
        'status' => TypeStatus::ACTIVE
    ];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'user_invite','event_id','user_id');
    }
}
