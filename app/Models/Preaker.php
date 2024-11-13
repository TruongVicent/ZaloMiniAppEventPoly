<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preaker extends Model
{
    protected $table = 'preakers';
    protected $fillable = [
        'name'
    ];
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_preaker');
    }
}
