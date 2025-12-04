<?php
namespace App\Http\Controllers\AdminControls;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewusersController extends Controller
{
    public function showNewusers()
    {
        
        $newusers = DB::table('users')->where('role', 'new')->where('removed', 'no')->paginate(5);
        return view('admin/newusers', ['newusers' => $newusers]);
    }
}
