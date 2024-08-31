@extends('layouts.auth_admin')

@section('title', 'អ្នកប្រើប្រាស់')
@push('custom_css')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush

@section('content_header')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">បញ្ជី អ្នកប្រើប្រាស់</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">ទំព័រដើម</a></li>
              <li class="breadcrumb-item active">បញ្ជី អ្នកប្រើប្រាស់</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">បញ្ជី អ្នកប្រើប្រាស់</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ល.រ</th>
                                <th>ឈ្មោះពេញ</th>
                                <th>E-Mail និងឈ្មោះប្រើប្រាស់</th>
                                <th>អាស័យដ្ឋាន</th>
                                <th>Avatar</th>
                                <th>ជម្រើស</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $user)
                                <tr id="user-row-{{ $user->id }}">
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        {{ $user->name }}
                                        <br>
                                        {{ $user->phone }}

                                    </td>
                                    <td>{{ $user->email }}
                                        <br>
                                        {{ $user->username }}
                                    </td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        <img style="width: 50px;" src="{{ asset($user->avatar) }}" alt="{{ $user->name }}">
                                    </td>
                                    <td>

                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fas fa-pencil-alt"></i>
                                            Edit</a>
                                        <button type="button"
                                            class="btn btn-sm btn-danger delete-user-button" data-id="{{ $user->id }}">
                                            <i class="fas fa-trash"></i>
                                            Delete</button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ល.រ</th>
                                <th>ឈ្មោះពេញ</th>
                                <th>E-Mail និងឈ្មោះប្រើប្រាស់</th>
                                <th>អាស័យដ្ឋាន</th>
                                <th>Avatar</th>
                                <th>ជម្រើស</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom_js')

<!-- DataTables  & Plugins -->
<script src="{{asset('backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('backend')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('backend')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('backend')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('backend')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
  $(function () {
    var table = $("#example1").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "buttons": [
        {
          text: 'Add',
          action: function (e, dt, node, config) {
            // Define what happens when the Add button is clicked
            window.location.href = "{{ route('admin.users.index') }}"; // Redirect to the add page
            // Alternatively, you could open a modal or trigger any other JavaScript function
            // $('#yourModal').modal('show');
          }
        },
        "copy",
        "csv",
        "excel",
        "pdf",
        "print",
        "colvis"
      ],
      "language": {
        "url": "{{ asset('lang/datatables-kh.json') }}"
      }
    });

    // Append the button container after the search input
    table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });




</script>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).on('click', '.delete-user-button', function(e) {
    e.preventDefault();
    var userId = $(this).data('id'); // Assuming the button has a data-id attribute with the user's ID
    var deleteUrl = "{{ route('admin.users.destroy', ':id') }}";
    deleteUrl = deleteUrl.replace(':id', userId);

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // alert(deleteUrl);
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(result) {
                    Swal.fire(
                        'Deleted!',
                        'User deleted successfully.',
                        'success'
                    ).then(() => {
                        // Optionally, remove the user from the DOM or refresh the page
                        // location.reload(); // Or you can remove the user row from the table
                        // Remove the user row from the table
                        $('#user-row-' + userId).remove();
                    });
                },
                error: function(result) {
                    Swal.fire(
                        'Failed!',
                        'Failed to delete user.',
                        'error'
                    );
                }
            });
        }
    });
});

</script>



@endpush
