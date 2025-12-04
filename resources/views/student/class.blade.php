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
        <div class="d-flex">
            <div class="side-bar-container">
                @include('layouts.student-nav-side-bar')
            </div>
            <div class="w-100 m-5">
                <h2>Class Options</h2>


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

                    <P>Your Class : {{$class->name ?? 'Not in Any class'}}</P>

                    <table class="table w-100 shadow rounded">
                        <thead class="w-100">
                            <tr class="table-dark">
                                <th class="border border-1 border-black text-center">Fellow Students</th>
                                <th class="border border-1 border-black text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="w-100">
                            @foreach($class->student as $student)
                            <tr>
                                 <td class="border border-1 border-black bg-white text-center">{{$student->name}}</td>
                                <td class="border border-1 border-black bg-white text-center">

                                    <button class="btn-primary">Message</button>
                                    
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