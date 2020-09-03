@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Marks Entry')
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
            <form id="myForm" action="{{route('student-marks-manage.store')}}" method="POST" id="myForm">
              @csrf
            <div class="form-group row">
              <div class="col-sm-3">
                <label for="inputName" class="col-form-label">Year</label>
                <select class="form-control select2 form-control-sm" style="width: 100%;" name="year_id" id="year_id">
                  <option value="">Select Year</option>
                  @foreach($yeares as $year)
                  <option value="{{$year->id}}" {{old('year_id') == $year->id ? 'selected' : ''}} >{{$year->year_name}}</option>
                  @endforeach
                </select>
                @if($errors->has('year_id'))
                  <strong class="text-danger">{{$errors->first('year_id')}}</strong>
                @endif
              </div>
              <div class="col-sm-3">
                <label for="inputName" class="col-form-label">Class</label>
                <select class="form-control select2bs4 form-control-sm" style="width: 100%;" name="class_id" id="class_id">
                  <option value="">Select class</option>
                  @foreach($classes as $class)
                  <option value="{{$class->id}}" {{old('class_id') == $class->id ? 'selected' : ''}}>{{$class->name}}</option>
                  @endforeach
                </select>
                @if($errors->has('class_id'))
                  <strong class="text-danger">{{$errors->first('class_id')}}</strong>
                @endif
              </div>
              <div class="col-sm-3">
                <label for="inputName" class="col-form-label">Subject</label>
                <select class="form-control select2bs4 form-control-sm" style="width: 100%;" name="assign_subjects_id" id="assign_subjects_id">
                  <option value="">Select Subject</option>

                </select>
                @if($errors->has('assign_subjects_id'))
                  <strong class="text-danger">{{$errors->first('assign_subjects_id')}}</strong>
                @endif
              </div>
              <div class="col-sm-3">
                <label for="inputName" class="col-form-label">Exam Type</label>
                <select class="form-control select2bs4 form-control-sm" style="width: 100%;" name="exam_type_id" id="exam_type_id">
                  <option value="">Select Exam Type</option>
                  @foreach($examType as $exam )
                    <option value="{{$exam->id}}" {{old('exam_type_id') == $exam->id ? 'selected' : ''}}>{{$exam->name}}</option>
                  @endforeach
                  </select>
                @if($errors->has('assign_subjects_id'))
                  <strong class="text-danger">{{$errors->first('assign_subjects_id')}}</strong>
                @endif
              </div>
              <div class="col-sm-4" style="padding-top:35px;">
                  <a id="search" class="btn btn-primary btn-sm" name="search" style="color:white">Search</a>
              </div>
          </div><br>
          <div class="row d-none" id="mark-entry">
            <div class="col-md-12">
              <table class="table table-bordered table-striped dt-responsive" style="width:100%">
                <thead>
                  <tr>
                    <th>ID NO</th>
                    <th>Roll</th>
                    <th>Student Name</th>
                    <th>Father's Name</th>
                    <th>Gender</th>
                    <th>Mark Entry</th>
                  </tr>
                </thead>
                <tbody id="mark-entry-tr">

                </tbody>
              </table>
            </div>
            <button type="submit" class="btn btn-success btn-sm">Mark Entry</button>
          </div>
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
    var assign_subjects_id = $('#assign_subjects_id').val();
    var exam_type_id = $('#exam_type_id').val();
    $('.toastr').html('');
    if(year_id==''){
      toastr.error("Year required",{className:'error'});
      return false;
    }
    if(class_id==''){
      toastr.error("Class required",{className:'error'});
      return false;
    }

    if(assign_subjects_id==''){
      toastr.error("Subject required",{className:'error'});
      return false;
    }
    if(exam_type_id==''){
      toastr.error("ExamType required",{className:'error'});
      return false;
    }

    $.ajax({
      url:"{{route('get-students')}}",
      type:"GET",
      data:{'year_id':year_id,'class_id':class_id},
      success:function(data){
        // console.log("hello");
        $('#mark-entry').removeClass('d-none');
        var html='';
        $.each(data,function(key, v){
         html +=
          '<tr>'+
            '<td>'+v.user.id_no+'<input type="hidden" name="student_id[]" value="'+v.student_id+'"><input type="hidden" name="id_no[]" value="'+v.user.id_no+'"></td>'+
            '<td>'+v.student_roll+'<input type="hidden" name="student_roll[]" value="'+v.student_roll+'"></td>'+
            '<td>'+v.user.name+'</td>'+
            '<td>'+v.user.fname+'</td>'+
            '<td>'+v.user.gender+'</td>'+
            '<td><input type="text" class="form-control form-control-sm" placeholder="Enter Marks"  name="marks[]"></td>'+
          '</tr>';
        });
        html = $('#mark-entry-tr').html(html);
      }
    });
  });
</script>
<!---subject load class wise--->
<script type="text/javascript">
  $(function(){
    $(document).on('change','#class_id',function(){
      var class_id = $('#class_id').val();
      $.ajax({
        url:"{{route('marks.getsubject')}}",
        type:'GET',
        data:{class_id:class_id},
        success:function(data){
          var html = '<option value="">Slelect Subject</option>';
          $.each(data,function(key, v){
            html +='<option value="'+v.id+'">'+v.student_subject.name+'</option>';//student_subject form assign model
          });
          $('#assign_subjects_id').html(html);
        }
      });
    });
  });
</script>
<!---form validation---->
<script type="text/javascript">
$(document).ready(function() {
$('#myForm').validate({
  rules: {
    "marks[]": {
      required: true,
      number: true,
    },
  },
  messages: {
    "mark[]": {
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
