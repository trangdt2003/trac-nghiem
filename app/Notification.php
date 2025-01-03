<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'notification',
        'time',
        'date'
    ];

    public function scopeSearch($query)
    {
        if ($key = request()->key) {
            $query = $query->where('notification', 'like', '%' . $key . '%');
        }
        return $query;

    }
}
