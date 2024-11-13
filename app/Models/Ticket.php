<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'name_student',
        'code_student',
        'email',
        'content_support',
        'problem_support',
        'who_support',
        'supported_at',
        'status',

    ];

    public static function newStatus(){
        return self::where('status','new')->count();
    }
    public static function in_progressStatus(){
        return self::where('status','in_progress')->count();
    }
    public static function resolvedStatus(){
        return self::where('status','resolved')->count();
    }

    public function getStatusLableAttribute(){

        return match ($this->status){
            'new' => 'Chưa hỗ trợ',
            'resolved' => 'Đã hỗ trợ',
        };
    }

}
