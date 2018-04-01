<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ['name', 'description', 'image_path'];
}
