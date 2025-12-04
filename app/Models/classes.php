<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\class_teacher;
use App\Models\user;
class classes extends Model
{

    // Tell Laravel which table this model represents
    protected $table = 'classes';

    // Columns you can fill manually
    protected $fillable = ['name'];

    public function teacher()
    {
        return $this->hasOneThrough(
            user::class,
            class_teacher::class,
            'class_id', // Foreign key on class_teacher table
            'id', // Foreign key on users table
            'id', // Local key on classes table
            'teacher_id' // Local key on class_teacher  table
        )->where('role', 'teacher')->where('removed', 'no');
    }
   
    public function student()
    {
        return $this->belongsToMany(
            user::class,
            'class_students',
            'class_id', 
            'student_id' 
        )->where('role', 'student')->where('removed', 'no');
    }
}
