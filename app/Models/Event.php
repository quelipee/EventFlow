<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'event';
    protected $fillable = [
        'description',
        'eventStart',
        'eventEnd'
    ];

    protected function casts() : array
    {
        return [
          'eventStart', 'eventEnd' => 'datetime:Y-m-d H:i:s',
        ];
    }
}
