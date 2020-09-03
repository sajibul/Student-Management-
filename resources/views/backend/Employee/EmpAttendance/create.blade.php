@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Employee Attendace')
@push('css')
<!-- DataTables -->
 <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
 <link rel="stylesheet" href="{{asset('public/backend/dist/css/attend.css')}}">
 <style type="text/css">
    .switch-toggle{
     width: auto;
   }
   .switch-toggle label:not(.disabled){
     cursor: pointer;
   }
   .switch-candy a{
     border:1px solid #333;
     border-radius: 3px;
     box-shadow: 0 1px 1px rgba(0, 0 ,0 , 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.45);
     background-color: white;
     background-image: -webkit-linear-gradient(top, rgba(255, 255, 255 , 0.2),transparent);
     background-image: linear-gradient(top bottom, rgba(255, 255, 255 , 0.2), transparent);
   }
   .switch-toggle.switch-candy, .switch-light.switch-candy  > span{
     background-color: #5a6268;
     border-radius: 3px;
     box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.3), 0 1px 0 rgba(255 , 255 ,255 , 0.2);
   }
 </style>
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
              @if(@$editData)
              Employee Attendace Edit
              @else
              Employee Attendace Create
              @endif
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('employee-attendance.index')}}"><i class="fa fa-plus-circle"></i>All Employee Attendace</a>
                </li>
              </ul>
            </div>
          </div><!-- /.card-header -->
              @if(Session::get('success'))<!---start alert Message---->
              <div class="alert alert-info btn-btn-success alert-dismissible fade show" role="alert">
                  <strong>Message:</strong>{{Session::get('success')}}
                  <button type="button" class="close" name="button" data-dismiss="alert" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              @endif<!---end alert Message-->
              <form class="" action="{{(@$editData) ?  route('employee-attendance.update',$editData['0']['date']) : route('employee-attendance.store')}}" method="post" id="myForm" enctype="multipart/form-data">
                @csrf
                @if(!empty(@$editData))
                @method('PUT')
                @endif
                @if(@$editData)
              <div class="card-body">
                <div class="form-group col-md-4">
                  <label class="control-lavel">Attendance Date</label>
                  <input type="text" name="date" id="date" class="checkdate form-control form-control-sm singledatepicker" id="inputName" placeholder="Today date"  value="{{@$editData['0']['date']}}" autocomplete="off" readonly>
                  @if($errors->has('date'))
                    <strong class="text-danger">{{$errors->first('date')}}</strong>
                  @endif
                </div>
                <table class="table-sm table-bordered table-striped dt-responsive" style="width:100%">
                  <thead>
                  <tr>
                    <th rowspan="2" class="text-center" style="vertical-align:middle">Sl.</th>
                    <th rowspan="2" class="text-center" style="vertical-align:middle">Name</th>
                    <th colspan="3" class="text-center" style="vertical-align:middle;width:25%;">Attendance</th>
                    </tr>
                    <tr>
                      <th class="text-center btn present_all" style="display:table-cell;background-color:#114190;color:white;">Present</th>
                      <th class="text-center btn leave_all" style="display:table-cell;background-color:#114190;color:white;">Leave</th>
                      <th class="text-center btn absent_all" style="display:table-cell;background-color:#114190;color:white;">Absent</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($editData as $key =>  $employee)
                   <tr id="div{{$employee->id}}" class="text-center">
                     <input type="hidden" name="employee_id[]" value="{{$employee->employee_id}}" class="employee_id">
                    <td>{{$key+1}}</td>
                    <td>{{$employee->employee->name}}</td>
                    <td colspan="3">
                     <div class="switch-toggle switch-3 switch-candy">
                       <input type="radio" class="present" id="present{{$key}}" name="attend_status{{$key}}" value="Present" {{($employee->attendance_status=='Present') ? 'checked' : ''}}/>
                       <label for="present{{$key}}">Present</label>
                       <input type="radio" class="leave" id="leave{{$key}}" name="attend_status{{$key}}" value="Leave" {{($employee->attendance_status=='Leave') ? 'checked' : ''}}/>
                       <label for="leave{{$key}}">Leave</label>
                       <input type="radio" class="absent" id="absent{{$key}}" name="attend_status{{$key}}" value="Absent" {{($employee->attendance_status=='Absent') ? 'checked' : ''}}/>
                       <label for="absent{{$key}}">Absent</label>
                       <a href="#"></a>
                     </div>
                   </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
                @else
              <div class="card-body">
                <div class="form-group col-md-4">
                  <label class="control-label">Attendance Date</label>
                  <input type="text" name="date" id="date" class="checkdate form-control form-control-sm singledatepicker" id="inputName" placeholder="Today date"  value="{{@$editData->date}}" autocomplete="off">
                  @if($errors->has('date'))
                    <strong class="text-danger">{{$errors->first('date')}}</strong>
                  @endif
                </div>
                <table class="table-sm table-bordered table-striped dt-responsive" style="width:100%">
                  <thead>
                  <tr>
                    <th rowspan="2" class="text-center" style="vertical-align:middle">Sl.</th>
                    <th rowspan="2" class="text-center" style="vertical-align:middle">Name</th>
                    <th colspan="3" class="text-center" style="vertical-align:middle;width:25%;">Attendance</th>
                    </tr>
                    <tr>
                      <th class="text-center btn present_all" style="display:table-cell;background-color:#114190;color:white;">Present</th>
                      <th class="text-center btn leave_all" style="display:table-cell;background-color:#114190;color:white;">Leave</th>
                      <th class="text-center btn absent_all" style="display:table-cell;background-color:#114190;color:white;">Absent</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($allemployee as $key => $employee)
                   <tr id="div{{$employee->id}}" class="text-center">
                     <input type="hidden" name="employee_id[]" value="{{$employee->id}}" class="employee_id">
                     <td>{{$key+1}}</td>
                    <td>{{$employee->name}}</td>
                    <td colspan="3">
                     <div class="switch-toggle switch-3 switch-candy">
                       <input type="radio" class="present" id="present{{$key}}" name="attend_status{{$key}}" value="Present"/ checked>
                       <label for="present{{$key}}">Present</label>
                       <input type="radio" class="leave" id="leave{{$key}}" name="attend_status{{$key}}" value="Leave" />
                       <label for="leave{{$key}}">Leave</label>
                       <input type="radio" class="absent" id="absent{{$key}}" name="attend_status{{$key}}" value="Absent"/>
                       <label for="absent{{$key}}">Absent</label>
                       <a href="#"></a>
                     </div>
                   </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
                @endif
              <div class="form-control text-center">
                <button type="submit" name="button" class="btn btn-success">{{(@$editData) ? 'Update' : 'Submit'}}</button>
              </div>
              </form>
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
<!--attendance--->
<script type="text/javascript">
  $(document).on('click','.present',function(){
    $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#495057');
  });
  $(document).on('click','.leave',function(){
    $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#495057');
  });
  $(document).on('click','.absent',function(){
    $(this).parents('tr').find('.datetime').css('pointer-events','none').css('background-color','#dee2e6').css('color','#495057');
  });
</script>
<script type="text/javascript">
  $(document).on('click','.present_all',function(){
    $("input[value=Present]").prop('checked',true);
    $('.datetime').css('pinter-events','none').css('background-color','#dee2e6').css('color','#495057');
  });
  $(document).on('click','.leave_all',function(){
    $("input[value=Leave]").prop('checked',true);
    $('.datetime').css('pinter-events','none').css('background-color','#dee2e6').css('color','#495057');
  });
  $(document).on('click','.absent_all',function(){
    $("input[value=Absent]").prop('checked',true);
    $('.datetime').css('pinter-events','none').css('background-color','#dee2e6').css('color','#495057');
  });
</script>
<!-- form validate -->
<script type="text/javascript">
  $(document).ready(function(){
    $('#myForm').validate({
      rules:{
        "date":{
          required:true,
          // unique:true,
        },
      },
      errorElement:'span',
      errorPlacement:function(error, element){
        error.addClass('invalid-feedback');
        element.closest('.form-query').append(error);
      },
      highlight:function(element, errorClass, validClass){
        $(element).addClass('is-invalid');
      },
      unhighlight:function(element,errorClass,validaClass){
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>

@endpush
