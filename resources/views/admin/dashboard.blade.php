@extends('layouts.admin-Layout')
@section('title','Admin | Teachers Controls')
@section('content')

<div class="w-100 p-4">
    <h2>Welcome to Dashboard</h2>
    <div>
        <div class="mt-5 d-flex justify-content-center align-items-center gap-5">
            <div class="d-flex gap-4 flex-column justify-content-center align-items-center shadow rounded" style="width: 200px;height: 200px;">
                <p class="h1">{{$totalStudents}}</p>
                <p class="h5">Total Students</p>
            </div>
            <div class="d-flex gap-4 flex-column justify-content-center align-items-center shadow rounded" style="width: 200px;height: 200px;">
                <p class="h1">{{$totalTeachers}}</p>
                <p class="h5">Total Teachers</p>
            </div>
            <div class="d-flex gap-4 flex-column justify-content-center align-items-center shadow rounded" style="width: 200px;height: 200px;">
                <p class="h1">{{$totalApplicants}}</p>
                <p class="h5">Total Applicants</p>
            </div>
            <div class="d-flex gap-4 flex-column justify-content-center align-items-center shadow rounded" style="width: 200px;height: 200px;">
                <p class="h1">{{$totalNewusers}}</p>
                <p class="h5">Total New Users</p>
            </div>
        </div>


        <div class="mt-5 d-flex justify-content-center align-items-center gap-5">
            <div class="d-flex gap-4 flex-column justify-content-center align-items-center shadow rounded" style="width: 200px;height: 200px;">
                <p class="h1">{{$totalUsers}}</p>
                <p class="h5">Total Users</p>
            </div>

        </div>
    </div>
  
</div>

@endSection