<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class remove_restore extends Controller
{
    public function remove(Request $request)
    {
        DB::table('users')->where('id', $request->removeID)->update(['removed' => 'yes']);
        return redirect()->back()->with('success', 'Target removed successfully.');
    }
    public function restore(Request $request)
    {
        DB::table('users')->where('id', $request->removeID)->update(['removed' => 'no']);
        return redirect()->back()->with('success', 'Target restored successfully.');
    }
}
