@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="mt-4">
            <table id="dataTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Reference</th>
                        <th scope="col">Description</th>
                        <th scope="col">Cost</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="item{{ $product->id }}">
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->reference }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->cost }}</td>
                            <td class="d-flex justify-content-center">
                                <a href="/home/{{ $product->id }}">
                                    <button type="button" class="btn btn-primary btn-sm mx-1">
                                        <i class="material-icons">remove_red_eye</i>
                                    </button>
                                </a>
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

    </script>
@endsection
