<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QnaExam extends Model
{
    public $table = "qna_exam";
    protected $fillable = [
        'exam_id',
        'question_id'

    ];

    public function question()
    {
        return $this->hasMany(Question::class,'id', 'question_id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class,  'questions_id', 'question_id');
    }


}
