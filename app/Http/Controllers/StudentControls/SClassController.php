<?php

namespace App\Http\Controllers\StudentControls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\classes;
use App\Models\class_student;
use App\Models\class_teacher;

class SClassController extends Controller
{

    public function aboutClass()
    {
        $classID = class_student::where('student_id', (session('user')->id))->first();
        $class = classes::with('student')->where('id', $classID->class_id)->first();
        $class->student = $class->student->reject(function ($student) {
            return $student->id === session('user')->id;
        });
        return view('student/class', compact('class'));
    }
}
