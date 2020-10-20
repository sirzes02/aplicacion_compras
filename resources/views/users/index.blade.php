@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div>
            <h2>
                List of users
                <a href="users/create">
                    <button type="button" class="btn btn-success float-right">Add user</button>
                </a>
            </h2>
        </div>

        <div class="mt-4">
            <table id="dataTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="item{{ $user->id }}">
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}
                                @endforeach
                            </td>
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('users.edit', $user->id) }}">
                                    <button type="button" class="btn btn-primary btn-sm mx-1">
                                        <i class="material-icons">create</i>
                                    </button>
                                </a>
                                <button class="delete-modal btn btn-danger btn-sm"
                                    data-info="{{ $user->id }},{{ $user->email }}">
                                    <i class="material-icons">delete_forever</i>
                                </button>
                            </td>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script type="application/javascript">
        $(document).ready(function() {
            $('#dataTable').DataTable({
                lengthMenu: [
                    [5, 10, 25, -1],
                    [5, 10, 25, "Todos"],
                ],
                columnDefs: [{
                    orderable: false,
                    searchable: false,
                    width: "12%",
                    targets: 4
                }],
            });
        });
        $(document).on('click', '.delete-modal', function() {
            var stuff = $(this).data('info').split(',');
            Swal.fire({
                title: 'Are you sure?',
                text: stuff[1] + " will be deleted",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!',
                cancelButtonText: "No"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "DELETE",
                        url: '/users/' + stuff[0],
                        data: {
                            "_token": $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            $('.item' + stuff[0]).remove();
                            Swal.fire(
                                'Deleted!',
                                'The user ' + stuff[1] + " was deleted successfully.",
                                'success'
                            );
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            console.error(XMLHttpRequest.responseText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                footer: '<a href>Why do I have this issue?</a>'
                            })
                        }
                    });
                }
            })
        });

    </script>
@endsection
