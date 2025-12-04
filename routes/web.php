<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AdminControls\StudentController;
use App\Http\Controllers\AdminControls\TeachersController;
use App\Http\Controllers\AdminControls\dashboard_stats;
use App\Http\Controllers\AdminControls\NewusersController;
use App\Http\Controllers\AdminControls\ApplicantsController;
use App\Http\Controllers\AdminControls\Removeduserscontroller;
use App\Http\Controllers\AdminControls\ClassesController;
use App\Http\Controllers\TeacherControls\AssignmentsController;
use App\Http\Controllers\TeacherControls\TClassesController;
use App\Http\Controllers\remove_restore;
use App\Http\Controllers\StudentControls\dashboardStats;
use App\Http\Controllers\StudentControls\SAssigmentsController;
use App\Http\Controllers\StudentControls\SClassController;

Route::get('/', function () {
    return view('welcome');
});


// admin links



// teacher links 

Route::get('/teacher/dashboard', function () {
    return view('teacher/dashboard');
})->middleware('checkTeacher');
Route::get('/teacher/profile', function () {
    return view('teacher/profile');
})->middleware('checkTeacher');

Route::get('/teacher/classes', [TClassesController::class, 'showClassInfo'])->middleware('checkTeacher');
Route::get('/teacher/classes/{class_id}', [TClassesController::class, 'showClassInfoByClass'])->name('teacher.classInfo.ByClass')->middleware('checkTeacher');
Route::get('/teacher/assignments', [AssignmentsController::class, 'index'])->middleware('checkTeacher');
Route::get('/teacher/assignments/{class_id}', [AssignmentsController::class, 'showByClass'])->name('teacher.assignments.class')->middleware('checkTeacher');


// teacher Assignments Controls 

Route::post('/addAssignment', [AssignmentsController::class, 'addAssignment'])->middleware('checkTeacher');
Route::post('/removeAssignment', [AssignmentsController::class, 'removeAssignment'])->middleware('checkTeacher');

// teacher classes controls 

Route::post('/TremoveFromClass', [TClassesController::class, 'TremoveFromClass']);

// students links 
Route::get('/student/dashboard', [dashboardStats::class, 'statsForStudent'])->middleware('checkStudent');
Route::get('/student/profile', function () {return view('student.profile');})->middleware('checkStudent');
Route::get('/student/class', [SClassController::class, 'aboutClass'])->middleware('checkStudent');
Route::get('/student/assignments', [SAssigmentsController::class, 'showAssignments'])->middleware('checkStudent');
Route::get('/student/grades', function () {return view('student.grades');})->middleware('checkStudent');

// student upload file controls 
Route::post('/upload_assigment', [SAssigmentsController::class, 'upload_assignment'])->middleware('checkStudent');
Route::post('/delete_assignment', [SAssigmentsController::class, 'delete_assignment'])->middleware('checkStudent');

// login controls links 

Route::get('/login', [AuthController::class, 'showLogin']);
Route::get('/signup', [AuthController::class, 'showSignup']);
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);


// user's controls 
Route::post('/adduser', [AuthController::class, 'Adduser']);
Route::post('/edituser', [AuthController::class, 'Edituser']);



// class controls for admin
Route::post('/addclass', [ClassesController::class, 'addClass'])->middleware('checkAdmin');
Route::post('/addInClass', [ClassesController::class, 'addInClass'])->middleware('checkAdmin');
Route::post('/removeFromClass', [ClassesController::class, 'removeFromClass'])->middleware('checkAdmin');
Route::post('/changeTeacher', [ClassesController::class, 'changeTeacher'])->middleware('checkAdmin');

// admin controls links

Route::get('/admin/students', [StudentController::class, 'showStudents'])->middleware('checkAdmin');
Route::get('/admin/teachers', [TeachersController::class, 'showTeachers'])->middleware('checkAdmin');
Route::get('/admin/dashboard', [dashboard_stats::class, 'stats'])->middleware('checkAdmin');
Route::get('/admin/newusers', [NewusersController::class, 'showNewusers'])->middleware('checkAdmin');
Route::get('/admin/applicants', [ApplicantsController::class, 'showApplicants'])->middleware('checkAdmin');
Route::get('/admin/removedusers', [Removeduserscontroller::class, 'showRemovedusers'])->middleware('checkAdmin');
Route::get('/admin/classes', [ClassesController::class, 'showClasses'])->middleware('checkAdmin');

// search control for in admin side 
Route::get('/search', [StudentController::class, 'searchStudents'])->middleware('checkAdmin');
Route::get('/selectedStudent', [StudentController::class, 'showStudents'])->middleware('checkAdmin');

Route::get('/searchTeacher', [TeachersController::class, 'searchTeachers'])->middleware('checkAdmin');
Route::get('/selectedteacher', [TeachersController::class, 'showTeachers'])->middleware('checkAdmin');

// crud 
// removing users 
Route::get('/remove', [remove_restore::class, 'remove'])->middleware('checkAdmin');

//restore users
Route::get('/restore', [remove_restore::class, 'restore'])->middleware('checkAdmin');

// class delete 
Route::get('/deleteclass', [ClassesController::class, 'deleteClass'])->middleware('checkAdmin');
