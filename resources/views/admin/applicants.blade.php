@extends('layouts.admin-Layout')
@section('title','Admin | Applicants Controls')
@section('content')

<div class="d-flex p-3 justify-content-between">
    <h2>Applicants</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary shadow" data-bs-toggle="modal" data-bs-target="#addApplicant">
        Add Applicant
    </button>
</div>

<table class="table w-100 shadow rounded">
    <thead class="w-100">
        <tr class="table-dark">
            <th class="border border-1 border-black text-center">Name</th>
            <th class="border border-1 border-black text-center">Email</th>
            <th class="border border-1 border-black text-center">Date of Applying</th>
            <th class="border border-1 border-black text-center">Status</th>
            <th class="border border-1 border-black text-center">Actions</th>
        </tr>
    </thead>
    <tbody class="w-100">
        @foreach($applicants as $applicant)
        <tr>
            <td class="border border-1 border-black bg-white ">{{ $applicant->name }}</td>
            <td class="border border-1 border-black bg-white ">{{ $applicant->email }}</td>
            <td class="border border-1 border-black bg-white text-center">{{ date('d - M - Y', strtotime($applicant->created_at)) }}</td>
            <td class="border border-1 border-black bg-white text-center">{{ $applicant->role }}</td>
            <td class="border border-1 border-black bg-white text-center">

                <!-- view -->

                <button class="btn btn-primary"><i class="fa-solid fa-eye"></i></button>

                <!-- edit -->

                <!-- Button trigger modal -->
                <button type="button" class="btn btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editapplicant{{$applicant->id}}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>

                <!-- Edit applicant modal -->
                <!-- Modal -->
                <div class="modal fade" id="editapplicant{{$applicant->id}}" tabindex="-1" aria-labelledby="editapplicant{{$applicant->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-start">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editapplicant{{$applicant->id}}Label">Edit Applicant Profile</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/edituser" method="POST" class="form d-flex flex-column p-3 ">
                                    @csrf

                                    <label class="form-label mt-3" for="username">New Username</label>
                                    <input type="hidden" name="id" value="{{$applicant->id}}">
                                    <input class="form-control" name="name" type="text" placeholder="username">

                                    <label class="form-label mt-3" for="Password">Old Password</label>
                                    <div class="d-flex border border-1 rounded align-items-center">
                                        <input class="form-control border-0 w-100 p-2" name="oldPassword" id="Password" type="password" placeholder="Old Password">
                                        <button type="button" id="eye" class="bg-transparent border-0 eye"><i class="fa-solid fa-eye mx-2"></i></button>
                                    </div>
                                    <label class="form-label mt-3" for="Password">New Password</label>
                                    <div class="d-flex border border-1 rounded align-items-center">
                                        <input class="form-control border-0 w-100 p-2" name="newPassword" id="newPassword" type="password" placeholder="New Password">
                                        <button type="button" id="eyeNew" class="bg-transparent border-0 eye"><i class="fa-solid fa-eye mx-2"></i></button>
                                    </div>
                                    <label class="form-label mt-3" for="ConfirmPassword">Confirm Password</label>
                                    <div class="d-flex border border-1 rounded align-items-center">
                                        <input class="form-control border-0 w-100 p-2" name="confirmPassword" id="confirmPassword" type="password" placeholder="Confirm Password">
                                        <button type="button" id="eyeConfirm" class="bg-transparent border-0 eye"><i class="fa-solid fa-eye mx-2"></i></button>
                                    </div>
                                    <input type="hidden" name="role" value="applicant">
                                    <button class="mt-4 rounded border-1 btn btn-primary" type="submit">Confirm Changes</button>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- delete -->

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#remove{{$applicant->id}}">
                    <i class="fa-solid fa-trash"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="remove{{$applicant->id}}" tabindex="-1" aria-labelledby="remove{{$applicant->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-start">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="remove{{$applicant->id}}Label">Confrim Remove</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete '{{$applicant->name}}' ?
                            </div>
                            <div class="modal-footer">
                                <form action="/remove" method="GET">
                                    <input type="hidden" name="removeID" value="{{$applicant->id}}">
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div>
    {{$applicants->links('pagination::bootstrap-5') }}
</div>

<!-- add applicants modal -->
<!-- Modal -->
<div class="modal fade" id="addApplicant" tabindex="-1" aria-labelledby="addApplicantLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addApplicantLabel">Add Applicant</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/adduser" method="POST" class="form d-flex flex-column p-3 ">
                    @csrf

                    <label class="form-label mt-3" for="username">Username</label>
                    <input class="form-control" name="name" type="text" placeholder="username">
                    <label class="form-label mt-3" for="Email">Email</label>
                    <input class="form-control" name="email" type="email" placeholder="Email">
                    <label class="form-label mt-3" for="Password">Password</label>
                    <div class="d-flex border border-1 rounded align-items-center">
                        <input class="form-control border-0 w-100 p-2" name="password" id="Password" type="password" placeholder="Password">
                        <button type="button" id="eye" class="bg-transparent border-0 eye"><i class="fa-solid fa-eye mx-2"></i></button>
                    </div>
                    <label class="form-label mt-3" for="ConfirmPassword">Confirm Password</label>
                    <div class="d-flex border border-1 rounded align-items-center">
                        <input class="form-control border-0 w-100 p-2" name="confirmPassword" id="confirmPassword" type="password" placeholder="Confirm Password">
                        <button type="button" id="eyeConfirm" class="bg-transparent border-0 eye"><i class="fa-solid fa-eye mx-2"></i></button>
                    </div>
                    <input type="hidden" name="role" value="applicant">
                    <button class="mt-4 rounded border-1 btn btn-primary" type="submit">Add</button>

                </form>
            </div>
        </div>
    </div>

</div>



@endSection