<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'questions_id',
        'answer',
        'is_correct'
    ];


}
