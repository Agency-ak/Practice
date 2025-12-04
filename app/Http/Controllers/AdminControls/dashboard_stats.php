<?php

namespace App\Http\Controllers\AdminControls;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboard_stats extends Controller
{
    public function stats()
    {

        $totalUsers = DB::table('users')->where('role', '!=', 'admin')->where('removed', 'no')->count();
        $totalStudents = DB::table('users')->where('role', 'student')->where('removed', 'no')->count();
        $totalTeachers = DB::table('users')->where('role', 'teacher')->where('removed', 'no')->count();
        $totalNewusers = DB::table('users')->where('role', 'new')->where('removed', 'no')->count();
        $totalApplicants = DB::table('users')->where('role', 'applicant')->where('removed', 'no')->count();

        return view('admin/dashboard', [
            'totalUsers' => $totalUsers,
            'totalStudents' => $totalStudents,
            'totalTeachers' => $totalTeachers,
            'totalNewusers' => $totalNewusers,
            'totalApplicants' => $totalApplicants
        ]);
    }
}
