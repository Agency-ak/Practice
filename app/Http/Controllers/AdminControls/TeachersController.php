<?php

namespace App\Http\Controllers\AdminControls;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\user;

class TeachersController extends Controller
{
  

    public function showTeachers(Request $request)
    {

        $selected = $request->selected;
        if (isset($selected)) {
            $teachers = user::with('classroom')->where('role', 'teacher')->where('removed', 'no')->where(function ($q) use ($selected) {
                $q->where('name','like', '%' . $selected . '%')
                    ->orWhere('email','like', '%' . $selected . '%');
            })->paginate(5);
        } else {

            $teachers = user::with('classroom')->where('role', 'teacher')->where('removed', 'no')->paginate(5);
        }
        return view('admin/teachers', ['teachers' => $teachers]);
    }

    public function searchTeachers(Request $request)
    {

        $query = $request->query('query');

        $teachers = user::with('classroom')->where('role', 'teacher')->where('removed', 'no')->where(function ($q) use ($query) {
                $q->where('name','like', '%' . $query . '%')
                    ->orWhere('email','like', '%' . $query . '%');
            })->get();
        return Response()->Json($teachers);
    }
}
