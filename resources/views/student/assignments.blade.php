<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student|Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <x-header />

    <div class="container-fluid p-0">
        <div class="d-flex ">
            <div class="side-bar-container">
                @include('layouts.student-nav-side-bar')
            </div>
            <div class="w-100 m-5">
                <div class="">

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

                    <h2>Assignments Options</h2>

                </div>
                <table class="table w-100 shadow rounded">
                    <thead class="w-100">
                        <tr class="table-dark">
                            <th class="border border-1 border-black text-center">Name</th>

                            <th class="border border-1 border-black text-center">Assigning Date</th>
                            <th class="border border-1 border-black text-center">Due Date</th>

                            <th class="border border-1 border-black text-center">Description</th>
                            <th class="border border-1 border-black text-center">Upload Assignment</th>
                        </tr>
                    </thead>
                    <tbody class="w-100">
                        @foreach($assignments as $assignment)
                        <tr>
                            <td class="border border-1 border-black bg-white ">{{ $assignment->name }}</td>

                            <td class="border border-1 border-black bg-white text-center">{{ date('d - M - Y', strtotime($assignment->created_at)) }}</td>
                            <td class="border border-1 border-black bg-white text-center">{{ date('d - M - Y', strtotime($assignment->due_date)) }}</td>
                            <td class="border border-1 border-black bg-white text-center">

                                <!-- view -->


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
                            <td class="border border-1 border-black bg-white text-center ">
                                @if($assignment->assignment_file === '')
                                <form class="d-flex gap-2" action="/upload_assigment" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input class="form-control" type="file" name="assignment_file" id="">
                                    <input type="hidden" name="id" value="{{$assignment->id}}">
                                    <button class="btn btn btn-success" type="submit"><i class="fa-solid fa-file-arrow-up"></i></button>
                                </form>
                                @else
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-primary" href="{{ asset('storage/' . $assignment->assignment_file) }}" target="_blank">View Assignment <i class="fa-solid fa-eye"></i></a>

                                    <form class="" action="/delete_assignment" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$assignment->id}}">
                                        <button class="btn btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>




        </div>
    </div>
    <script src="{{ asset('js/form.js') }}"></script>
</body>

</html>