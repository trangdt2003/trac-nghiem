<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'exam_name',
        'subject_id',
        'date',
        'time',
        'attempt'
    ];

    public function subjects(){
        return $this->hasMany(Subject::class,'id','subject_id');
    }

    public function getQnaExam(){
        return $this->hasMany(QnaExam::class,'exam_id','id');
    }

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('exam_name', 'like', '%' . $key . '%')
                ->orWhereHas('subjects', function ($query) use ($key) {
                    $query->where('subject', 'like', '%' . $key . '%');
                });
        }
        return $query;
    }

}
