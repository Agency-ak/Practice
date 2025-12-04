@extends('layouts.admin-Layout')
@section('title','Admin | Classes Controls')
@section('content')

<div class="d-flex p-3 justify-content-between">
    <h2>Classes Data</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClass">
        Add Classes
    </button>
</div>
<table class="table shadow">
    <thead>
        <tr class="table-dark">
            <th class="border border-1 border-black text-center">#</th>
            <th class="border border-1 border-black text-center">Class Name</th>
            <th class="border border-1 border-black text-center">Class Teacher</th>
            <th class="border border-1 border-black text-center">Total Students</th>
            <th class="border border-1 border-black text-center">Created At</th>
            <th class="border border-1 border-black text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($classes as $class)
        <tr>
            <td class="border border-1 border-black text-center">{{ ($classes->currentPage() - 1) * $classes->perPage() + $loop->iteration }}</td>
            <td class="border border-1 border-black">{{ $class->name }}</td>
            <td class="border border-1 border-black">{{ $class->teacher->name ?? 'No Teacher Assigned' }}</td>
            <td class="border border-1 border-black text-center">{{ $class->student->count() }}</td>
            <td class="border border-1 border-black text-center">{{ date('d - M - Y', strtotime($class->created_at)) }}</td>
            <td class="border border-1 border-black text-center">

                <!-- View Info -->

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#info{{$class->id}}">
                    <i class="fa-solid fa-eye"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="info{{$class->id}}" tabindex="-1" aria-labelledby="info{{$class->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-start">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="info{{$class->id}}Label">Class Info</h1>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">


                                <div class="w-100 broder d-flex gap-2">
                                    <div class="w-100">
                                        <div class="border border-black rounded p-2 m-2  w-100 ">
                                            <h5>Class Teacher</h5>
                                            <p>{{ $class->teacher->name ?? 'No Teacher Assigned' }}</p>
                                        </div>
                                        <div class="border border-black rounded p-2 m-2 w-100 ">
                                            <h5>Total Student</h5>
                                            <p>{{ $class->student->count() }}</p>
                                        </div>

                                    </div>
                                    <div class="border border-black rounded p-2 m-2 w-100">
                                        <h5>Class Students</h5>
                                        <ol>
                                            @foreach($class->student as $student)
                                            <li class="">
                                                <p class="">{{$student->name}}</p>
                                            </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- add students -->
                <!-- Button trigger modal -->

                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addInClass{{$class->id}}">
                    <i class="fa-solid fa-plus"></i>
                </button>

                <!-- model -->

                <div class="modal fade" id="addInClass{{$class->id}}" tabindex="-1" aria-labelledby="addInClass{{$class->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-start">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addInClass{{$class->id}}Label">Add Students</h1>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/addInClass" method="POST">
                                    @csrf
                                    <input type="hidden" name="classID" value="{{$class->id}}">
                                    @foreach($students as $student)
                                    <div>
                                        <input type="checkbox" name="students[]" value="{{$student->id}}" id="student{{$student->id}}">
                                        <label for="student{{$student->id}}">{{$student->name}}</label>
                                    </div>
                                    @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Add</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- edit class -->

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#edit{{$class->id}}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="edit{{$class->id}}" tabindex="-1" aria-labelledby="edit{{$class->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-start">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="edit{{$class->id}}Label">Edit Class</h1>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="w-100 broder d-flex gap-2">
                                    <div class="w-100">
                                        <div class="border border-black rounded p-2 m-2  w-100 ">
                                            <h5>Class Teacher</h5>
                                            <div class="d-flex flex-column justify-content-between">
                                                <p class="mb-0">{{ $class->teacher->name ?? 'No Teacher Assigned' }}</p>
                                                <hr>
                                                <form action="/changeTeacher" method="post" class="w-100">
                                                    @csrf
                                                    <div class="d-flex flex-column">
                                                        <input type="hidden" name="oldTeacher" value="{{$class->teacher->id ?? NULL}}">
                                                        <input type="hidden" name="classID" value="{{$class->id}}">
                                                        <label for="selectTeacher">Select teacher</label>
                                                        <select name="newTeacher" class="mt-2" id="selectTeacher">
                                                            @foreach($teachers as $teacher)
                                                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button class="btn border btn-primary mt-2 ms-auto">
                                                        Change <i class="fa-solid fa-arrow-right-arrow-left"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="border border-black rounded p-2 m-2 w-100 ">
                                            <h5>Total Student</h5>
                                            <p>{{ $class->student->count() }}</p>
                                        </div>

                                    </div>
                                    <div class="border border-black rounded p-2 m-2 w-100">
                                        <h5>Class Students</h5>

                                        @foreach($class->student as $student)

                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="mb-0">{{$student->name}}</p>
                                            <form action="/removeFromClass" method="post">
                                                @csrf
                                                <input type="hidden" name="remove_student" value="{{$student->id}}">
                                                <button type="submit" class="btn border btn-transparent text-danger">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </form>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- delete -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#remove{{$class->id}}">
                    <i class="fa-solid fa-trash"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="remove{{$class->id}}" tabindex="-1" aria-labelledby="remove{{$class->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-start">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="remove{{$class->id}}Label">Confrim Remove</h1>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to permanently delete Class '{{$class->name}}' ?
                            </div>
                            <div class="modal-footer">
                                <form action="/deleteclass" method="GET">
                                    <input type="hidden" name="removeID" value="{{$class->id}}">
                                    <button type="submit" class="btn btn-danger">Delete</button>
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
    {{$classes->links('pagination::bootstrap-5') }}
</div>

<!-- Modal -->

<div class="modal fade" id="addClass" tabindex="-1" aria-labelledby="addClassLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addClassLabel">Add Class</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/addclass" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="class-name" class="col-form-label">Class Name:</label>
                        <input type="text" class="form-control" id="class-name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="class-teacher" class="col-form-label">Select Teacher:</label>
                        <select class="form-select" id="class-teacher" name="teacher_id" required>
                            <option disabled selected>Select a teacher...</option>
                            @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Add Class</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endSection