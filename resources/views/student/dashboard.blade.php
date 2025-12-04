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


                <h2>Welcome '{{session('user')->name}}'</h2>

                <div class="d-flex justify-content-between ">
                    <div class="d-flex flex-column p-3 align-items-center">
                        Total Assignments
                        <div class="p-4  h2 rounded-pill mt-2 shadow ">
                            " {{$total_assignments}} "
                        </div>
                    </div>
                    <div class="d-flex flex-column p-3 align-items-center">
                        New Assignments
                        <div class="p-3 rounded-3 mt-2 shadow ">
                            "number_here"
                        </div>
                    </div>
                    <div class="d-flex flex-column p-3 align-items-center">
                        Pending Assignments
                        <div class="p-3 rounded-3 mt-2 shadow ">
                            "number_here"
                        </div>
                    </div>
                    <div class="d-flex flex-column p-3 align-items-center">
                        Completed Assignments
                        <div class="p-3 rounded-3 mt-2 shadow ">
                            "number_here"
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('js/form.js') }}"></script>
</body>

</html>