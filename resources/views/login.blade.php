<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>

    </style>
</head>

<body>
    <div class="container pt-5">
        <form action="/login" method="POST" class="form d-flex flex-column p-3 border shadow rounded m-auto mt-5" style="width: 400px;">
            @csrf
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
            <h3 class="text-center">Login</h3>
            <label class="form-label mt-3" for="username">Email</label>
            <input class="form-control" name="email" type="text" placeholder="Email">
            <label class="form-label mt-3" for="Password">Password</label>
            <div class="d-flex border border-1 rounded align-items-center">
                <input class="form-control border-0 w-100 p-2" id="Password" name="password" type="password" placeholder="Password">
                <button type="button" id="eye" class="bg-transparent border-0 eye"><i class="fa-solid fa-eye mx-2"></i></button>
            </div>
            <div class="mt-4">
                <p>
                    Don't have an account ? <a href="/signup">SignUp</a>
                </p>
            </div>
            <button class="mt-2 rounded border-1 btn btn-primary" type="submit">Login</button>
        </form>
    </div>
    <script src="{{ asset('js/form.js') }}"></script>
</body>

</html>