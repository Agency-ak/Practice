@extends('layouts.admin-Layout')
@section('title','Admin | Removed-Users Controls')
@section('content')


<div>

    <h2>Removed Users</h2>

</div>

<table class="table w-100 shadow rounded">
    <thead class="w-100">
        <tr class="table-dark">
            <th class="border border-1 border-black text-center">Name</th>
            <th class="border border-1 border-black text-center">Email</th>

            <th class="border border-1 border-black text-center">Status</th>
            <th class="border border-1 border-black text-center">Actions</th>
        </tr>
    </thead>
    <tbody class="w-100">
        @foreach($removedusers as $removeduser)
        <tr>
            <td class="border border-1 border-black bg-white ">{{ $removeduser->name }}</td>
            <td class="border border-1 border-black bg-white ">{{ $removeduser->email }}</td>

            <td class="border border-1 border-black bg-white text-center">{{ $removeduser->role }}</td>
            <td class="border border-1 border-black bg-white text-center">

                <!-- view -->

                <button class="btn btn-primary"><i class="fa-solid fa-eye"></i></button>

                <!-- restore -->

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#restore{{$removeduser->id}}">
                    <i class="fa-solid fa-trash-can-arrow-up"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="restore{{$removeduser->id}}" tabindex="-1" aria-labelledby="restore{{$removeduser->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content text-start">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="restore{{$removeduser->id}}Label">Confrim Restore</h1>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to restore '{{$removeduser->name}}' ?
                            </div>
                            <div class="modal-footer">
                                <form action="/restore" method="GET">
                                    <input type="hidden" name="removeID" value="{{$removeduser->id}}">
                                    <button type="submit" class="btn btn-success">Restore</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- delete -->

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div>
    {{$removedusers->links('pagination::bootstrap-5') }}
</div>

@endSection