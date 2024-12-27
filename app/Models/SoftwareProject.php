<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoftwareProject extends Model
{
    protected $table = 'software_project';
    protected $fillable = [
        'name',
        'members',
        'level',
        'progress',
        'star_date',
        'end_date',
        'content'
    ];
}
