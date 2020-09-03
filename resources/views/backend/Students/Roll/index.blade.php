@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Roll Generate')
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
            Search Critera
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <!-- <a class="nav-link active" href="{{route('registration-student.create')}}"><i class="fa fa-plus-circle"></i>Add Student</a> -->
                </li>
              </ul>
            </div>
          </div><!-- /.card-header -->
          <div class="card-header">
            <form id="myForm" action="{{route('student-roll-generate.store')}}" method="POST" id="myForm">
              @csrf
            <div class="form-group row">
              <div class="col-sm-4">
                <label for="inputName" class="col-form-label">Year</label>
                <select class="form-control select2 form-control-sm" style="width: 100%;" name="year_id" id="year_id">
                  <option value="">Select Year</option>
                  @foreach($yeares as $year)
                  <option value="{{$year->id}}">{{$year->year_name}}</option>
                  @endforeach
                </select>
                @if($errors->has('year_id'))
                  <strong class="text-danger">{{$errors->first('year_id')}}</strong>
                @endif
              </div>
              <div class="col-sm-4">
                <label for="inputName" class="col-form-label">Class</label>
                <select class="form-control select2 form-control-sm" style="width: 100%;" name="class_id" id="class_id">
                  <option value="">Select class</option>
                  @foreach($classes as $class)
                  <option value="{{$class->id}}">{{$class->name}}</option>
                  @endforeach
                </select>
                @if($errors->has('class_id'))
                  <strong class="text-danger">{{$errors->first('class_id')}}</strong>
                @endif
              </div>
              <div class="col-sm-4" style="padding-top:35px;">
                  <a id="search" class="btn btn-primary btn-sm" name="search" style="color:white">Search</a>
              </div>
          </div><br>
          <div class="row d-none" id="roll-generate">
            <div class="col-md-12">
              <table class="table table-bordered table-striped dt-responsive" style="width:100%">
                <thead>
                  <tr>
                    <th>ID NO</th>
                    <th>Student Name</th>
                    <th>Father's Name</th>
                    <th>Gender</th>
                    <th>Roll No</th>
                  </tr>
                </thead>
                <tbody id="roll-generate-tr">

                </tbody>
              </table>
            </div>
          </div>
          <button type="submit" class="btn btn-success btn-sm">Roll Generate</button>
        </form>
              <!-- <div class="card-body">

              </div> -->
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
<script>
  $(document).on('click','#search',function(){
    var year_id = $('#year_id').val();
    var class_id = $('#class_id').val();
    $('.toastr').html('');
    if(year_id==''){
      toastr.error("Year required",{className:'error'});
      return false;
    }
    if(class_id==''){
      toastr.error("Class required",{className:'error'});
      return false;
    }

    $.ajax({
      url:"{{route('get-student-roll')}}",
      type:"GET",
      data:{'year_id':year_id,'class_id':class_id},
      success:function(data){
        console.log("hello");
        $('#roll-generate').removeClass('d-none');
        var html='';
        $.each(data,function(key, v){
         html +=
          '<tr>'+
            '<td>'+v.user.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"></td>'+
            '<td>'+v.user.name+'</td>'+
            '<td>'+v.user.fname+'</td>'+
            '<td>'+v.user.gender+'</td>'+
            '<td><input type="text" class="form-control form-control-sm" placeholder="Enter Roll"  name="roll[]" value="'+v.student_roll+'"></td>'+
          '</tr>';
        });
        html = $('#roll-generate-tr').html(html);
      }
    });
  });
</script>
<script type="text/javascript">
$(document).ready(function() {
$('#myForm').validate({
  rules: {
    "roll[]": {
      required: true,
      number: true,
    },
  },
  messages: {
    "roll[]": {
      required: "Please enter a email address",
    },
  },
  errorElement: 'span',
  errorPlacement: function (error, element) {
    error.addClass('invalid-feedback');
    element.closest('.form-group').append(error);
  },
  highlight: function (element, errorClass, validClass) {
    $(element).addClass('is-invalid');
  },
  unhighlight: function (element, errorClass, validClass) {
    $(element).removeClass('is-invalid');
  }
});
});
</script>
@endpush
