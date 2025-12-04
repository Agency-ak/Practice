<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class assignment extends Model
{
    protected $table = 'assignments';

    protected $fillable = [
        'name',
        'description',
        'status',
        'due_date',
        'class_id', 
        'teacher_id',
        'student_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
