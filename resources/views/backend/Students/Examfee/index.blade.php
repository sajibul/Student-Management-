@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Student Exam Fee')
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
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fa fa-th"></i>
            Search Critera
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <!-- <a class="nav-link active" href=""><i class="fa fa-plus-circle"></i>Add Student</a> -->
                </li>
              </ul>
            </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="form-group row">
              <div class="col-sm-3">
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
              <div class="col-sm-3">
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
              <div class="col-sm-3">
                <label for="inputName" class="col-form-label">Exam Type</label>
                <select class="form-control select2 form-control-sm" style="width: 100%;" name="exam_type" id="exam_type">
                  <option value="">Select Exam</option>
                  @foreach($exams as $data)
                  <option value="{{$data->id}}">{{$data->name}}</option>
                  @endforeach
                </select>
                @if($errors->has('exam_type'))
                  <strong class="text-danger">{{$errors->first('exam_type')}}</strong>
                @endif
              </div>
              <div class="col-sm-2" style="padding-top:35px;">
                  <a id="search" class="btn btn-primary btn-sm" name="search" style="color:white">Search</a>
              </div>
           </div>
          </div>
          <div class="card-body">
            <div id="DocumentResults"></div>
            <script id="document-template" type="text/x-handlebars-template">
                <table class="table-sm table-bordered table-striped" style="width:100%">
                  <thead>
                    <tr>
                      @{{{thsource}}}
                    </tr>
                  </thead>
                  <tbody>
                    @{{#each this}}
                    <tr>
                      @{{{tdsource}}}
                    </tr>
                    @{{/each}}
                  </tbody>
                </table>
            </script>
          </div>

        </div>
        </div>
      </div>
    </div>
</section>
@endsection
@push('js')

<!-- DataTables -->
<script src="{{asset('public/backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('public/backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('public/backend')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('public/backend')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('public/backend')}}/dist/js/handlebars-v4.0.12.js"></script>
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
    var exam_type = $('#exam_type').val();
    $('.toastr').html('');
    if(year_id==''){
      toastr.error("Year required",{className:'error'});
      return false;
    }
    if(class_id==''){
      toastr.error("Class required",{className:'error'});
      return false;
    }
    if(exam_type==''){
      toastr.error("Exam Type required",{className:'error'});
      return false;
    }

    $.ajax({
      url:"{{route('exam-fee.create')}}",
      type:"get",
      data:{'year_id':year_id,'class_id':class_id,'exam_type':exam_type},
      beforeSend: function(){

      },
      success:function(data){
        var source = $("#document-template").html();
        var template = Handlebars.compile(source);
        var html = template(data);
        console.log(html);
        $('#DocumentResults').html(html);
        $('[data-toggle="tooltip"]').tooltip();
      }
    });
  });
</script>
@endpush
