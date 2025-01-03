<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    public $table = 'exams_answer';

    protected $fillable = [
        'attempt_id',
        'question_id',
        'answer_id '
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
