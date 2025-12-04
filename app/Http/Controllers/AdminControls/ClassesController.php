<?php

namespace App\Http\Controllers\AdminControls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\classes;
use App\Models\class_teacher;
use App\Models\class_student;
use App\Models\user;

class ClassesController extends Controller
{



    public function showClasses()
    {
        $classes = classes::with(['teacher', 'student'])->paginate('5');
        $teachers = user::where('role', 'teacher')->where('removed', 'no')->get();
        $assignedStudents = class_student::pluck('student_id')->filter()->toArray();
        $students = user::where('role', 'student')->where('removed', 'no')->whereNotIn('id', $assignedStudents)->get();
        return view('admin/classes', ['classes' => $classes, 'teachers' => $teachers, 'students' => $students]);
    }

    public function addClass(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'teacher_id' => 'exists:users,id'
        ]);

        $class = classes::create([
            'name' => $request->input('name'),
        ]);
        
        if($request->teacher_id === NULL){
        return redirect()->back()->with('success', 'Class added successfully!');
        }

        class_teacher::create([
            'class_id' => $class->id,
            'teacher_id' => $request->input('teacher_id') 
        ]);

        return redirect()->back()->with('success', 'Class added successfully!');
    }





    public function deleteClass(Request $request)
    {
        $classId = $request->input('removeID');

        // Deleting reltionships
        class_teacher::where('class_id', $classId)->delete();
        class_student::where('class_id', $classId)->delete();

        // Delete the class itself
        classes::where('id', $classId)->delete();

        return redirect()->back()->with('success', 'Class deleted successfully!');
    }





    public function addInClass(Request $request)
    {
        $classID = $request->classID;
        $students = $request->students;
        if($students === NULL){
            return redirect()->back()->with('error', 'No Student Selected');
        }
        foreach ($students as $student) {
            class_student::create([
                'class_id' => $classID,
                'student_id' => $student
            ]);
        }
        return redirect()->back()->with('success', 'Students added successfully!');
    }





    public function removeFromClass(Request $request){
        $remove_student = $request->input('remove_student');
        class_student::where('student_id', $remove_student)->delete();
        return redirect()->back()->with('success', 'Student removed From Class successfully!');
    }





    public function changeTeacher(Request $request){

        $oldTeacher = $request->oldTeacher;
        $newTeacher = $request->newTeacher;
        $classID = $request->classID;

        if($oldTeacher === NULL){

            class_teacher::create([
            'class_id' => $classID,
            'teacher_id' => $newTeacher
            
        ]);
        return redirect()->back()->with('success', 'Teacher Assigned!');
    }
        class_teacher::where('teacher_id',$oldTeacher)->where('class_id',$classID)->update(['teacher_id' => $newTeacher]);
        return redirect()->back()->with('success', 'Teacher changed!');
    }
}
