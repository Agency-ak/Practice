<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class class_teacher extends Model
{
    protected $fillable = ['class_id', 'teacher_id'];
    public $timestamps = false;
}
