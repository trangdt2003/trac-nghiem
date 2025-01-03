<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class ExamAttempt extends Model
{
    public $table = 'exams_attempt';
    protected $fillable = [
      'exam_id',
      'user_id'
    ];
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }
}
