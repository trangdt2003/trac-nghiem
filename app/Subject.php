<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'subject'
    ];

    public function questions(){
        return $this->hasMany(Question::class, 'subject_id', 'id');
    }

    public function documents(){
        return $this->belongsTo(Document::class, 'subject_id', 'id');
    }

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('subject', 'like', '%' . $key . '%');
        }
        return $query;

    }
}
