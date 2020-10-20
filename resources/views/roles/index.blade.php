  @section('styles')
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
  @endsection

  @extends('layouts.app')

  @section('content')
      <div class="container mt-4">
          <div>
              <h2>
                  List of roles
                  <a href="roles/create">
                      <button type="button" class="btn btn-success float-right">Add rol</button>
                  </a>
              </h2>
          </div>
          <div class="mt-4">
              <table id="dataTable" class="table table-bordered table-hover">
                  <thead>
                      <tr>
                          <th scope="col">ID</th>
                          <th scope="col">Name</th>
                          <th scope="col">Label</th>
                          <th scope="col">Options</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($roles as $role)
                          <tr class="item{{ $role->id }}">
                              <th scope="row">{{ $role->id }}</th>
                              <td>{{ $role->name }}</td>
                              <td>{{ $role->label }}</td>
                              <td class="d-flex justify-content-center">
                                  <button class="delete-modal btn btn-danger btn-sm"
                                      data-info="{{ $role->id }},{{ $role->name }}">
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
                      width: "4%",
                      targets: 3
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
                          url: '/roles/' + stuff[0],
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
