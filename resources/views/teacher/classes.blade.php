<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher | Classes</title>
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

                <h2>Classes Options</h2>

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

                <div class="mb-2">

                    <a href="/teacher/classes" class="btn rounded-0 border border-black shadow me-1 {{!isset($active) ? 'btn-dark' : 'btn-light' }}">All</a>
                    @foreach($classes as $class)
                    <a href="{{ route('teacher.classInfo.ByClass', $class->id) }}" class="btn rounded-0 border border-black shadow me-1 {{isset($active) && $active == $class->id ? 'btn-dark' : 'btn-light' }}">{{$class->name}}</a>

                    @endforeach
                </div>
                <div>
                    <p class="h5 my-3">Number Of Students : <span class="text-white px-3 py-2 rounded-pill bg-primary">{{count($students)}}</span></p>
                </div>
                <div>
                    <table class="table">
                        <thead>
                            <tr class="table-dark">
                                
                                <th class="border border-1 border-white text-center">Students</th>
                                <th class="border border-1 border-white text-center">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                            <tr>
                                
                                <td class="border border-black text-center">{{$student->name}}</td>
                                
                                <td class="border border-black text-center">

                                    <!-- delete -->
                                         <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#remove{{$student->id}}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="remove{{$student->id}}" tabindex="-1" aria-labelledby="remove{{$student->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-start">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="remove{{$student->id}}Label">Confrim Remove</h1>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to Remove '{{$student->name}}' From Class  ?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="/TremoveFromClass" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="removeID" value="{{$student->id}}">
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
                </div>

            </div>
            
        </div>
    </div>
    <script src="{{ asset('js/form.js') }}"></script>
</body>

</html>