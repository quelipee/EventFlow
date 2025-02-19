<?php

namespace App\Models;

use App\EventDomain\TypeStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'title',
        'description',
        'eventStart',
        'eventEnd',
        'user_id',
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
