<?php

namespace App\Http\Controllers\StudentControls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\classes;
use App\Models\class_student;
use App\Models\class_teacher;
use App\Models\assignment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SAssigmentsController extends Controller
{
    public function showAssignments(){
        $assignments = assignment::where('student_id', session('user')->id)->get();
        return view('student/assignments', compact('assignments'));
    }
    public function upload_assignment(Request $request){
        $request->validate([
            'assignment_file'=> 'required|mimes:pdf,doc,xls,docx,png,jpeg',
            'id'=> 'required',
        ]);

        $id = $request->id;
        $file = $request->file('assignment_file');
        $filename =session('user')->name. "_" . Str::uuid() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('assignments', $filename, 'public');

        assignment::where('id', $id)->update(['assignment_file'=> $path, 'status' => 'submitted']);
        return back()->with('success', 'File Uploaded Successfully!');
    }
    public function delete_assignment(Request $request){
        $request->validate([

            'id'=> 'required'
        ]);
        $id = $request->id;
        $assignment = assignment::where('id', $id)->first();

        if($assignment->assignment_file && Storage::disk('public')->exists($assignment->assignment_file)){
            Storage::disk('public')->delete($assignment->assignment_file);
        }

        assignment::where('id', $id)->update(['assignment_file'=> '', 'status' => 'pending']);
        return back()->with('success', 'Assignment is removed');
    }
}
