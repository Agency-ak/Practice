<?php

namespace App\Http\Controllers\TeacherControls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use App\Models\assignment;
use App\Models\classes;
use App\Models\class_student;
use App\Models\class_teacher;

class AssignmentsController extends Controller
{
    public function index()
    {
        $teacher_ID = session('user')->id;
        $classes_IDs = class_teacher::where('teacher_id', $teacher_ID)->pluck('class_id')->toArray();
        $classes = classes::whereIn('id', $classes_IDs)->get();

        $assignments = assignment::where('teacher_id', $teacher_ID)->get();
        return view('teacher/assignments', compact('classes', 'assignments'));
    }

    public function showByClass($class_id)
    {
        $teacher_ID = session('user')->id;
        $classes_IDs = class_teacher::where('teacher_id', $teacher_ID)->pluck('class_id')->toArray();
        $classes = classes::whereIn('id', $classes_IDs)->get();
        $singleClass = classes::where('id', $class_id)->first();
        $students_id = class_student::where('class_id', $class_id)->pluck('student_id')->toArray();
        $students = user::whereIn('id', $students_id)->get();
        $assignments = Assignment::with(['class', 'teacher', 'student'])->where('class_id', $class_id)->get();
        return view('teacher/assignments', compact('students', 'assignments', 'classes', 'singleClass'));
    }

    public function addAssignment(Request $request)
    {

        $request->validate(
            [
                'name' => 'required|string|max:100',
                'due_date' => 'required|date',
                'description' => 'string',
                'class_id' => 'required',
                'student_id' => 'required',
                'teacher_id' => 'exists:users,id'

            ],[
                'student_id.required' => 'Please select atleast one student'
            ]

        );

        $name = $request->name;
        $due_date = $request->due_date;
        $description = $request->description;
        $class_id = $request->class_id;
        $student_ids = $request->student_id;
        $teacher_id = $request->teacher_id;

        foreach ($student_ids as $student) {
            assignment::create([
                'name' => $name,
                'due_date' => $due_date,
                'description' => $description,
                'class_id' => $class_id,
                'student_id' => $student,
                'teacher_id' => $teacher_id
            ]);
        }
        return back()->with('success', 'Assignment Assigned');
    }


    public function removeAssignment(Request $request)
    {
        assignment::where('id', $request->removeID)->delete();
        return back()->with('success', 'Assignment Deleted');
    }
}
