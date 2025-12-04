<?php

namespace App\Http\Controllers\TeacherControls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\classes;
use App\Models\class_student;
use App\Models\class_teacher;

class TClassesController extends Controller
{
    
    public function showClassInfo(){
        $classes_IDs = class_teacher::where('teacher_id', session('user')->id)->pluck('class_id')->toArray();
        $classes = classes::with('student')->whereIn('id',$classes_IDs)->get();
        $students = $classes->pluck('student')->flatten();
        return view('teacher/classes', compact('classes','students') );
    }
    public function showClassInfoByClass($class_id){
        $classes_IDs = class_teacher::where('teacher_id', session('user')->id)->pluck('class_id')->toArray();
        $classes = classes::with('student')->whereIn('id',$classes_IDs)->get();
        $class = classes::with('student')->where('id', $class_id)->get();
        $students = $class->pluck('student')->flatten();
        $active = $class_id ;
        return view('teacher/classes', compact('classes','students', 'active') );
    }

    public function TremoveFromClass(Request $request){
        class_student::where('student_id', $request->removeID)->delete();

        return back()->with('success', 'student removed from the class successfully');
    }
}
