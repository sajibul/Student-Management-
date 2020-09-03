@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Employee Salary')
@push('css')
<!-- DataTables -->
 <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
<!--start index-->
<section class="content">
  <div class="container-fluid">
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fa fa-th"></i>
              Employee Salary List
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <!-- <a class="nav-link active" href="{{route('employee-registration.create')}}"><i class="fa fa-plus-circle"></i>Add Employee Salary</a> -->
                </li>
              </ul>
            </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="card">
              @if(Session::get('success'))
              <div class="alert alert-info btn-btn-success alert-dismissible fade show" role="alert">
                  <strong>Message:</strong>{{Session::get('success')}}
                  <button type="button" class="close" name="button" data-dismiss="alert" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endif
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sl.</th>
                    <th>Employee Name</th>
                    <th>Designation</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Salary</th>
                    <th>Picture</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $i=1;
                    @endphp
                    @foreach($allemployee as $employee)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$employee->name}}</td>
                    <td>{{$employee->designation->name}}</td>
                    <td>{{$employee->mobile}}</td>
                    <td>{{$employee->gender}}</td>
                    <td>{{$employee->salary}}TK</td>
                    <td>
                      <img class="profile-user-img img-fluid"
                      src="{{!empty($employee->image) ? asset('public/storage/Employee/'.$employee->image) : asset('public/backend/dist/img/empty.jpg') }}"
                      alt="pic" style="width:80px;">
                    </td>
                    <td>
                      <a title="details" target="_blank" href="{{route('employee-salary.show',$employee->id)}}"><i class="btn btn-sm btn-success fa fa-eye"></i></a>
                      <a title="Salary Increment" href="{{route('employee-salary.edit',$employee->id)}}"><i class="btn btn-sm btn-primary fas fa-edit" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Sl.</th>
                    <th>Employee Name</th>
                    <th>Designation</th>
                    <th>Mobile</th>
                    <th>Gender</th>
                    <th>Salary</th>
                    <th>Picture</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div><!-- /.card-body -->
        </div>
      </section>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection
@push('js')
<!-- DataTables -->
<script src="{{asset('public/backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('public/backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('public/backend')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('public/backend')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!--sweet alert--->
<script type="text/javascript">
          function studentClass(id) {
            const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false,
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
    event.preventDefault();
    document.getElementById('destroy-'+id).submit();
  } else if (
    // Read more about handling dismissals
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
          }
   </script>
@endpush
