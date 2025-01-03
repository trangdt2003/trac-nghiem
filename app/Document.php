<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'subject_id',
        'name',
        'document'
    ];

    public function subjects(){
        return $this->hasMany(Subject::class,'id','subject_id');
    }

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('name', 'like', '%' . $key . '%')
                ->orWhereHas('subjects', function ($query) use ($key) {
                    $query->where('subject', 'like', '%' . $key . '%');
                });
        }
        return $query;
    }
}
