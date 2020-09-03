@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Students')
@push('css')
<!-- DataTables -->
 <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
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
              Students List
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('registration-student.create')}}"><i class="fa fa-plus-circle"></i>Add Student</a>
                </li>
              </ul>
            </div>
          </div><!-- /.card-header -->
          <div class="card-header">
            <form class="" action="{{route('search-year-class-student')}}" method="GET" id="myForm">
            <div class="form-group row">
              <div class="col-sm-4">
                <label for="inputName" class="col-form-label">Year</label>
                <select class="form-control select2 form-control-sm" style="width: 100%;" name="year_id">
                  <option value="">Select Year</option>
                  @foreach($yeares as $year)
                  <option value="{{$year->id}}" {{(@$year_id==$year->id) ? 'selected' : ''}}>{{$year->year_name}}</option>
                  @endforeach
                </select>
                @if($errors->has('year_id'))
                  <strong class="text-danger">{{$errors->first('year_id')}}</strong>
                @endif
              </div>
              <div class="col-sm-4">
                <label for="inputName" class="col-form-label">Class</label>
                <select class="form-control select2 form-control-sm" style="width: 100%;" name="class_id">
                  <option value="">Select class</option>
                  @foreach($classes as $class)
                  <option value="{{$class->id}}" {{(@$class_id==$class->id) ? 'selected' : ''}}>{{$class->name}}</option>
                  @endforeach
                </select>
                @if($errors->has('class_id'))
                  <strong class="text-danger">{{$errors->first('class_id')}}</strong>
                @endif
              </div>
              <div class="col-sm-4" style="padding-top:35px;">
                  <button type="submit" class="btn btn-primary btn-sm" name="search">Search</button>
              </div>
          </form>
          </div>
            @if(Session::get('success'))
          <div class="alert alert-info btn-btn-success alert-dismissible fade show" role="alert">
            <strong>Message:</strong>{{Session::get('success')}}
            <button type="button" class="close" name="button" data-dismiss="alert" aria-label="close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
              <div class="card-body">
                @if(!@$search)
                <table id="example1" class="table table-bordered table-striped">
                  <thead>

                  <tr>
                    <th>Sl.</th>
                    <th>Stuent Name</th>
                    <th>ID NO</th>
                    <th>Roll</th>
                    @if(Auth::user()->role_id==1)
                    <th>Code</th>
                    @endif
                    <th>Year</th>
                    <th>Class</th>
                    <th>Image</th>
                    <th >Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                  @foreach($data as $datainfo)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$datainfo->user->name}}</td>
                    <td>{{$datainfo->user->id_no}}</td>
                    <td>{{$datainfo->student_roll}}</td>
                    @if(Auth::user()->role_id==1)
                    <td>{{$datainfo->user->code}}</td>
                    @endif
                    <td>{{$datainfo->year->year_name}}</td>
                    <td>{{$datainfo->class->name}}</td>
                    <td>
                      <img class="profile-user-img img-fluid"
                      src="{{!empty($datainfo->user->image) ? url('public/storage/students/'.$datainfo->user->image) : asset('public/backend/dist/img/empty.jpg') }}"
                      alt="pic" style="width:80px;">
                    </td>
                    <td>
                      <a title="Details" target="_blank" href="{{route('registration-student.show',$datainfo->student_id)}}"><i class="btn btn-sm btn-success fa fa-plus-square fa-lg"></i></a>
                      <a title="edit" href="{{route('registration-student.edit',$datainfo->student_id)}}"> <i class="btn btn-sm btn-primary fas fa-edit" aria-hidden="true"></i></a>
                      <a title="promotion" href="{{route('student-class-promotion',$datainfo->student_id)}}"> <i class="btn btn-sm btn-secondary fas fa-check" aria-hidden="true"></i></a>
                      <!-- <button type="button" name="button" onclick="ExamType({{$datainfo->student_id}})" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-lg"></i></button>
                      <form id="destroy-{{$datainfo->id}}" action="{{route('registration-student.destroy',$datainfo->student_id)}}" method="post">
                        @csrf
                        @method('Delete')
                      </form> -->
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Sl.</th>
                    <th>Stuent Name</th>
                    <th>ID NO</th>
                    <th>Roll</th>
                    @if(Auth::user()->role_id==1)
                    <th>Code</th>
                    @endif
                    <th>Year</th>
                    <th>Class</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                @else
                <table id="example1" class="table table-bordered table-striped">
                  <thead>

                  <tr>
                    <th>Sl.</th>
                    <th>Stuent Name</th>
                    <th>ID NO</th>
                    <th>Roll</th>
                    @if(Auth::user()->role_id==1)
                    <th>Code</th>
                    @endif
                    <th>Year</th>
                    <th>Class</th>
                    <th>Image</th>
                    <th >Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                  @foreach($data as $datainfo)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$datainfo->user->name}}</td>
                    <td>{{$datainfo->user->id_no}}</td>
                    <td>{{$datainfo->student_roll}}</td>
                    @if(Auth::user()->role_id==1)
                    <td>{{$datainfo->user->code}}</td>
                    @endif
                    <td>{{$datainfo->year->year_name}}</td>
                    <td>{{$datainfo->class->name}}</td>
                    <td>
                      <img class="profile-user-img img-fluid"
                      src="{{!empty($datainfo->user->image) ? url('public/storage/students/'.$datainfo->user->image) : asset('public/backend/dist/img/empty.jpg') }}"
                      alt="pic" style="width:80px;">
                    </td>
                    <td>
                      <a title="view" href="{{route('registration-student.show',$datainfo->student_id)}}"><i class="btn btn-sm btn-success fa fa-plus-square fa-lg"></i></a>
                      <a title="edit" href="{{route('registration-student.edit',$datainfo->student_id)}}"> <i class="btn btn-sm btn-primary fas fa-edit" aria-hidden="true"></i></a>
                      <a title="promotion" href="{{route('student-class-promotion',$datainfo->student_id)}}"> <i class="btn btn-sm btn-secondary fas fa-check" aria-hidden="true"></i></a>
                      <!-- <button type="button" name="button" onclick="ExamType({{$datainfo->student_id}})" class="btn btn-sm btn-danger"><i class="fa fa-trash fa-lg"></i></button>
                      <form id="destroy-{{$datainfo->id}}" action="{{route('registration-student.destroy',$datainfo->student_id)}}" method="post">
                        @csrf
                        @method('Delete')
                      </form> -->
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Sl.</th>
                    <th>Stuent Name</th>
                    <th>ID NO</th>
                    <th>Roll</th>
                    @if(Auth::user()->role_id==1)
                    <th>Code</th>
                    @endif
                    <th>Year</th>
                    <th>Class</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
                @endif
              </div>
          </div><!-- /.card-body -->
        </div>
      </section>
      <!-- right col -->
    </div>
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
          function ExamType(id) {
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
