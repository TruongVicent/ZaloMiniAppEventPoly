<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'name',
        'image',
        'event_type_id',
        'content',
        'start_time',
        'end_time',
        'taget_audience',
        'status',
        'address'
//        'preaker_id'
    ];

    public function EventType():BelongsTo
    {
        return $this->belongsTo(EventType::class)->where('status',1);
    }

    public function Preaker()
    {
        return $this->belongsToMany(Preaker::class, 'event_preaker');
    }
}
