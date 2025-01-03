<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question',
        "subject_id"
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class, 'questions_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($question) {
            $question->answers()->delete();
        });
    }

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('question', 'like', '%' . $key . '%');
        }
        return $query;

    }

}
