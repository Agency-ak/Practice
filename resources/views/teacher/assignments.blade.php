<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher | Assignments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <x-header />
    <div class="container-fluid p-0">
        <div class="d-flex">
            <div class="side-bar-container">
                @include('layouts.teacher-nav-side-bar')
            </div>
            <div class="w-100 m-5">

                <h2>Assignments Options</h2>

                <div class="mb-2">
                    <a class="btn rounded-0 border border-black shadow me-1 {{ isset($singleClass) ? 'btn-light' : 'btn-dark' }}" href="/teacher/assignments">All</a>
                    @foreach($classes as $class)
                    <a class="btn rounded-0 border border-black shadow me-1 {{ isset($singleClass) && $singleClass->id == $class->id ? 'btn-dark' : 'btn-light' }}" href="{{ route('teacher.assignments.class', $class->id) }}">{{$class->name}} Class</a>
                    @endforeach
                </div>


                @if ($errors->any())
                <div class="alert alert-danger mb-3 p-3 rounded">
                    <strong>Oops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                @if(isset($students))
                <div class="w-100 d-flex justify-content-between my-3">
                    <h3>Assignments</h3>

                    <!-- Button trigger modal -->

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAssignments">
                        New Assignment
                    </button>

                    <!-- Modal -->

                    <div class="modal fade" id="createAssignments" tabindex="-1" aria-labelledby="createAssignmentsLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="createAssignmentsLabel">Create Assignment</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="/addAssignment" method="post">
                                        @csrf
                                        <h5>{{$singleClass->name}}</h5>
                                        <label for="" class="form-label">Name</label>
                                        <input class="form-control" type="text" name="name">
                                        <label for="" class="form-label">Due Date</label>
                                        <input class="form-control" type="date" name="due_date">
                                        <label for="" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id=""></textarea>
                                        <div class="d-flex align-items-center border rounded">

                                            <input type="hidden" name="class_id" value="{{$singleClass->id}}">
                                            <input type="hidden" name="teacher_id" value="{{session('user')->id}}">
                                        </div>
                                        <h5>Assigned To</h5>
                                        <div class="d-flex flex-column">
                                            <div>

                                                <input id="all" class="allCheck" type="checkbox">
                                                <label for="al" class="form-label">All</label>

                                            </div>
                                            @foreach($students as $student)

                                            <div>
                                                <input id="students-list{{$student->id}}" class="studentCheck" type="checkbox" name="student_id[]" value="{{$student->id}}">
                                                <label for="students-list{{$student->id}}" class="form-label">{{$student->name}}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @endif
                <h1 class="text-center">{{isset($singleClass->name) ? $singleClass->name : 'All Assignments'}}</h1>
                <!-- assignments info table -->
                <div>
                    <table class="table">
                        <thead>
                            <tr class="table-dark">
                                <th class="border border-1 border-white text-center">Name</th>
                                <th class="border border-1 border-white text-center">Description</th>
                                <th class="border border-1 border-white text-center">Given by</th>
                                <th class="border border-1 border-white text-center">Student Name</th>
                                <th class="border border-1 border-white text-center">Class Name</th>
                                <th class="border border-1 border-white text-center">Assigning Date</th>
                                <th class="border border-1 border-white text-center">Due Date</th>
                                <th class="border border-1 border-white text-center">Status</th>
                                <th class="border border-1 border-white text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignments as $assignment)
                            <tr>
                                <td class="border border-black text-center">{{$assignment->name}}</td>
                                <td class="border border-black text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-tranparent dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ Str::limit($assignment->description, 5) }}
                                        </button>
                                        <ul class="dropdown-menu bg-dark ">
                                            <li class="dropdown-item bg-dark text-white text-wrap ">
                                                <p>{{$assignment->description}}</p>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td class="border border-black text-center">Professor {{$assignment->teacher->name}}</td>
                                <td class="border border-black text-center">{{$assignment->student->name}}</td>
                                <td class="border border-black text-center">{{$assignment->class->name}}</td>
                                <td class="border border-black text-center">{{ date('d - M - Y', strtotime($assignment->updated_at)) }}</td>
                                <td class="border border-black text-center">{{ date('d - M - Y', strtotime($assignment->due_date)) }}</td>
                                <td class="border border-black text-center">{{$assignment->status}}</td>
                                <td class="border border-black text-center">


                                    <!-- view -->
                                    @if($assignment->assignment_file)
                                    <a class="btn btn-primary" href="{{asset('storage/'.$assignment-> assignment_file)}}"><i class="fa-solid fa-eye"></i></a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#grade{{$assignment->id}}">
                                        Grade
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="grade{{$assignment->id}}" tabindex="-1" aria-labelledby="grade{{$assignment->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="grade{{$assignment->id}}Label">Grade The Assignment</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/grade">
                                                        <input type="hidden" name="id" value="{{$assignment->id}}">
                                                        <Label>Select The Grade</Label>
                                                        <select name="grade" id="">
                                                            <option value="A+">A+</option>
                                                            <option value="A">A</option>
                                                            <option value="B+">B+</option>
                                                            <option value="B">B</option>
                                                            <option value="C">C</option>
                                                            <option value="D">D</option>
                                                            <option value="E">E</option>
                                                            <option value="F">F</option>
                                                        </select>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">OK</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <!-- delete -->
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#remove{{$assignment->id}}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="remove{{$assignment->id}}" tabindex="-1" aria-labelledby="remove{{$assignment->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content text-start">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="remove{{$assignment->id}}Label">Confrim Delete</h1>

                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you permanently want to delete this Assignment ' ?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="/removeAssignment" method="post">
                                                        @csrf
                                                        <input type="hidden" name="removeID" value="{{$assignment->id}}">
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
                </div>

            </div>
        </div>
    </div>



    <script>
        const checkAll = document.querySelector('.allCheck');
        const checkStudents = document.querySelectorAll('.studentCheck');
        checkAll.addEventListener('change', () => {
            if (checkAll.checked) {
                checkStudents.forEach(student => student.checked = true);
            } else {
                checkStudents.forEach(student => student.checked = false);
            }
        });
    </script>


    <script src="{{ asset('js/form.js') }}"></script>
</body>

</html>