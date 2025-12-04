<?php

namespace App\Http\Controllers\AdminControls;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use PHPUnit\Util\Json;
use App\Models\User;

class StudentController extends Controller
{
    public function showStudents(Request $request)
    {

        $selected = $request->selected;
        if (isset($selected)) {
            $students = user::with('classroom')->where('role', 'student')->where('removed', 'no')->where(function ($q) use ($selected) {
                $q->where('name','like', '%' . $selected . '%')
                    ->orWhere('email','like', '%' . $selected . '%');
            })->paginate(5);
        } else {

            $students = user::with('classroom')->where('role', 'student')->where('removed', 'no')->paginate(5);
        }
        return view('admin/students', ['students' => $students]);
    }

    public function searchStudents(Request $request)
    {

        $query = $request->query('query');

        $students = user::with('classroom')->where('role', 'student')->where('removed', 'no')->where(function ($q) use ($query) {
                $q->where('name','like', '%' . $query . '%')
                    ->orWhere('email','like', '%' . $query . '%');
            })->get();
        return Response()->Json($students);
    }
}
