<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $fillable = ['name', 'elapsed_time', 'total_weight'];

    public function user()
    {
        return $this->belongsTo('App/User');
    }

    public function exercises()
    {
        return $this->hasMany('App/Exercise');
    }
}
