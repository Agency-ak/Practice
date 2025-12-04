<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function showSignup()
    {
        return view('signup');
    }



    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|min:6',
        ]);

        if ($request->password !== $request->confirmPassword) {
            return redirect('/signup')->with('error', 'Please confirm your password');
        }

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/login')->with('success', 'Account Created! Please Login to Continue..');
    }

    public function login(Request $request)
    {
        $user = DB::table('users')->where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $request->session()->put('user', $user);
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            } elseif ($user->role === 'teacher') {
                return redirect('/teacher/dashboard');
            } else {
                return redirect('/student/dashboard');
            }
        }

        return back()->with('error', 'Invalid email or password!');
    }

    public function Adduser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'confirmPassword' => 'required|min:6',
            'role' => 'required|in:teacher,student,applicant,new',
        ]);

        if ($request->password !== $request->confirmPassword) {
            return back()->with('error', 'Please confirm your password');
        }

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
            'role' => $request->role,
        ]);

        return back()->with('success', 'Account Created!');
    }




    public function Edituser(Request $request)
    {

        $user = DB::table('users')->where('id', $request->id)->first();
        $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'newPassword' => 'required|min:6',
            'oldPassword' => 'required',
            'confirmPassword' => 'required|min:6',
        ]);
        if (!($user && Hash::check($request->oldPassword, $user->password))) {
            return back()->with('error', 'Your old password is incorrect');
        }
        if ($request->newPassword !== $request->confirmPassword) {
            return back()->with('error', 'Please confirm your password');
        }

        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->name,
            'password' => Hash::make($request->newPassword),
            'updated_at' => now(),
        ]);

        if (session('user')->id == $request->id) {
            $updatedUser = DB::table('users')->where('id', $request->id)->first();
            $request->session()->put('user', $updatedUser);
        }

        return back()->with('success', 'Account Updated!');
    }





    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
