<?php

namespace App\Http\Controllers\AdminControls;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ApplicantsController extends Controller
{
    public function showApplicants()
    {
    
        $applicants = DB::table('users')->where('role', 'applicant')->where('removed', 'no')->paginate(5);
        return view('admin/applicants', ['applicants' => $applicants]);
    }
}
