@extends('layouts.admin-Layout')
@section('title','Admin | Students Controls')
@section('content')


<h2>Visitor Users</h2>
<table class="table table-hover  w-100 shadow rounded">
    <thead class="w-100">
        <tr class="table-dark">
            <th class="border border-1 border-black text-center">Name</th>
            <th class="border border-1 border-black text-center">Email</th>
            <th class="border border-1 border-black text-center">Status</th>
            <th class="border border-1 border-black text-center">Actions</th>
        </tr>
    </thead>
    <tbody class="w-100">
        @foreach($newusers as $newuser)
        <tr>
            <td class="border border-1 border-black bg-white ">{{ $newuser->name }}</td>
            <td class="border border-1 border-black bg-white ">{{ $newuser->email }}</td>

            <td class="border border-1 border-black bg-white text-center">{{ $newuser->role }}</td>
            <td class="border border-1 border-black bg-white text-center">

                <!-- delete -->

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#remove{{$newuser->id}}">
                    <i class="fa-solid fa-trash"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="remove{{$newuser->id}}" tabindex="-1" aria-labelledby="remove{{$newuser->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-start">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="remove{{$newuser->id}}Label">Confrim Remove</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete '{{$newuser->name}}' ?
                            </div>
                            <div class="modal-footer">
                                <form action="/remove" method="GET">
                                    <input type="hidden" name="removeID" value="{{$newuser->id}}">
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
        {{$newusers->links('pagination::bootstrap-5') }}
    </div>

@endSection