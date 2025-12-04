<?php

namespace App\Http\Controllers\StudentControls;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\assignment;

class dashboardStats extends Controller
{
    public function statsForStudent(){
        $total_assignments = assignment::where('student_id', session('user')->id)->count();
        return view('student/dashboard', ['total_assignments'=>$total_assignments]);
    }
}
