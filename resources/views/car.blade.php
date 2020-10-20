@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div>
            <h2>
                List in carrito
                <a href="car/removeAll">
                    <button type="button" class="btn btn-danger float-right">Remove All</button>
                </a>
                <button type="button" class="btn btn-primary float-right">Refresh</button>
            </h2>
        </div>

        <div class="mt-4">
            <table id="dataTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Reference</th>
                        <th scope="col">Quantiy</th>
                        <th scope="col">Total</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->reference }}</td>
                            <td>{{ $product->cant }}</td>
                            <td>{{ $product->total }}</td>
                            <td class="d-flex justify-content-center">
                                <button class="delete-modal btn btn-danger btn-sm" data-info="{{ $product->reference }}">
                                    <i class="material-icons">delete_forever</i>
                                </button>
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
            var stuff = $(this).data('info');
            Swal.fire({
                title: 'Are you sure?',
                text: stuff + " will be deleted",
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
                        url: '/car/' + stuff,
                        data: {
                            "_token": $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            $('.item' + stuff).remove();
                            Swal.fire(
                                'Deleted!',
                                'The product ' + stuff + " was deleted successfully.",
                                'success'
                            ).then(() => location.reload());
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
