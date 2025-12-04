@extends('layouts.admin-Layout')
@section('title','Admin | Teachers Controls')
@section('content')



<div class="d-flex p-3 justify-content-between">
    <h2>Teachers Data</h2>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary shadow" data-bs-toggle="modal" data-bs-target="#addTeacher">
        Add Teacher
    </button>
</div>

<div class="mb-2 d-flex justify-content-between">
    <form action="/selectedteacher" method="get">
        <label for="search">Search : </label>
        <input class="rounded-pill p-1 border-black border-1 px-4" type="search" name="selected" id="search">
        <button type="submit" class="rounded-pill bg-transparent border-1 border-black p-0 p-1 px-2 "><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>

</div>
<div id="results" class="mb-2">
    <!-- it will contain the searched results -->
</div>

<table class="table w-100 shadow rounded">
    <thead class="w-100">
        <tr class="table-dark">
            <th class="border border-1 border-black text-center">Name</th>
            <th class="border border-1 border-black text-center">Email</th>
            <th class="border border-1 border-black text-center">Date of Joining</th>
            <th class="border border-1 border-black text-center">Status</th>
            <th class="border border-1 border-black text-center">Actions</th>
        </tr>
    </thead>
    <tbody class="w-100">
        @foreach($teachers as $teacher)
        <tr>
            <td class="border border-1 border-black bg-white ">{{ $teacher->name }}</td>
            <td class="border border-1 border-black bg-white ">{{ $teacher->email }}</td>
            <td class="border border-1 border-black bg-white text-center">{{ date('d - M - Y', strtotime($teacher->created_at)) }}</td>
            <td class="border border-1 border-black bg-white text-center">{{ $teacher->role }}</td>
            <td class="border border-1 border-black bg-white text-center">
                <!-- view -->

                <button class="btn btn-primary"><i class="fa-solid fa-eye"></i></button>

                <!-- edit -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editteacher{{$teacher->id}}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>

                <!-- Edit Teacher modal -->
                <!-- Modal -->
                <div class="modal fade" id="editteacher{{$teacher->id}}" tabindex="-1" aria-labelledby="editteacher{{$teacher->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-start">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editteacher{{$teacher->id}}Label">Edit Teacher Profile</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="/edituser" method="POST" class="form d-flex flex-column p-3 ">
                                    @csrf

                                    <label class="form-label mt-3" for="username">New Username</label>
                                    <input type="hidden" name="id" value="{{$teacher->id}}">
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
                                    <input type="hidden" name="role" value="student">
                                    <button class="mt-4 rounded border-1 btn btn-primary" type="submit">Confirm Changes</button>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- delete -->

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#remove{{$teacher->id}}">
                    <i class="fa-solid fa-trash"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="remove{{$teacher->id}}" tabindex="-1" aria-labelledby="remove{{$teacher->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-start">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="remove{{$teacher->id}}Label">Confrim Remove</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete '{{$teacher->name}}' ?
                            </div>
                            <div class="modal-footer">
                                <form action="/remove" method="GET">
                                    <input type="hidden" name="removeID" value="{{$teacher->id}}">
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
{{$teachers->links('pagination::bootstrap-5') }}

<!-- Modals -->


<!-- add Teacher modal -->

<div class="modal fade" id="addTeacher" tabindex="-1" aria-labelledby="addTeacherLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addTeacherLabel">Add Teacher</h1>
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
                        <button type="button" id="eye" class="bg-transparent border-0"><i class="fa-solid fa-eye mx-2"></i></button>
                    </div>
                    <label class="form-label mt-3" for="ConfirmPassword">Confirm Password</label>
                    <div class="d-flex border border-1 rounded align-items-center">
                        <input class="form-control border-0 w-100 p-2" name="confirmPassword" id="confirmPassword" type="password" placeholder="Confirm Password">
                        <button type="button" id="eyeConfirm" class="bg-transparent border-0"><i class="fa-solid fa-eye mx-2"></i></button>
                    </div>
                    <input type="hidden" name="role" value="teacher">
                    <button class="mt-4 rounded border-1 btn btn-primary" type="submit">Add</button>

                </form>
            </div>
        </div>
    </div>

</div>

<script>
    const search = document.getElementById('search');
    const results = document.getElementById('results');
    const showAll = document.getElementById('showAll');


    search.addEventListener('keyup', () => {
        const query = search.value.trim();

        if (query === '') {
            results.innerHTML = '';
            results.style.display = 'none';
            return;
        }

        fetch(`/searchTeacher?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                results.innerHTML = '';
                results.style.display = 'block';

                if (data.length === 0) {
                    results.innerHTML = '<p class="text-center p-2 mb-0">No results found</p>';
                    return;
                }

                data.forEach(user => {
                    const item = document.createElement('div');
                    item.classList.add('p-2', 'border-bottom', 'hover-bg');
                    item.style.cursor = 'pointer';
                    item.textContent = user.name;

                    // When user clicks a suggestion
                    item.addEventListener('click', () => {
                        search.value = user.name;
                        results.innerHTML = '';
                        results.style.display = 'none';
                    });

                    results.appendChild(item);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    // Hide suggestions when clicking outside
    document.addEventListener('click', (e) => {
        if (!results.contains(e.target) && e.target !== search) {
            results.innerHTML = '';
            results.style.display = 'none';
        }
    });
</script>

@endSection