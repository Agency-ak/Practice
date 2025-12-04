<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class class_student extends Model
{

    // Tell Laravel which table this model represents
    protected $table = 'class_students';

    protected $fillable = ['class_id', 'student_id'];
    public $timestamps = false;
}
