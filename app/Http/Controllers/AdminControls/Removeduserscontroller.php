<?php

namespace App\Http\Controllers\AdminControls;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Removeduserscontroller extends Controller
{
      public function showRemovedusers()
    {
      
        $removedusers = DB::table('users')->where('removed', 'yes')->paginate(5);
        return view('admin/removedusers', ['removedusers' => $removedusers]);
    }
}
