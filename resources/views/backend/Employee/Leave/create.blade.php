@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Employee List')
@push('css')

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
              <i class="fa fa-plus-circle"></i>
              @if(isset($editData))
              Edit Employee
              @else
              Add Employee
              @endif
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('employee-leave.index')}}"><i class="fa fa-th"></i>Employee Leave List</a>
                </li>
              </ul>
            </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="card">
              <div class="card-body">

                @if(Session::get('success'))
              <div class="alert alert-info btn-btn-success alert-dismissible fade show" role="alert">
                <strong>Message:</strong>{{Session::get('success')}}
                <button type="button" class="close" name="button" data-dismiss="alert" aria-label="close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
                <form class="form-horizontal" id="myForm" action="{{(@$editData) ? route('employee-leave.update',$editData->id) : route('employee-leave.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @if(!empty(@$editData))
                  @method('PUT')
                  @endif
                  <div class="form-group row">
                    <input type="hidden" name="id"  id="id"  value="{{@$editData->id}}">
                    <div class="col-sm-3 form-query">
                      <label for="inputName" class="col-form-label">Employee<font style="color:red">*</font> </label>
                      <select class="form-control select2 form-control-sm" style="width: 100%;" name="employee_id">
                        <option value="">Select Employee</option>
                        @foreach($allemployee as $employee)
                        <option value="{{$employee->id}}" {{@$editData->employee_id==$employee->id ?'selected' : ''}}>{{$employee->name}}</option>
                        @endforeach
                      </select>
                      @if($errors->has('employee_id'))
                        <strong class="text-danger">{{$errors->first('employee_id')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-3 form-query">
                      <label for="inputName" class="col-form-label">Leave Purpose<font style="color:red">*</font> </label>
                      <select class="form-control select2 form-control-sm" style="width: 100%;" name="leave_purposes_id" id="leave_purposes_id">
                        <option value="">Select Purpose</option>
                        @if(!@$editData)
                        <option value="0">Add New Purpose</option>
                        @endif
                        @foreach($purpose as $data)
                        <option value="{{$data->id}}" {{@$editData->leave_purposes_id==$data->id ? 'selected' : ''}}>{{$data->name}}</option>
                        @endforeach
                      </select>
                      @if(!@$editData)
                      <input type="text" class="form-control" name="new_purpose" value="" placeholder="Enter leave purpose" id="new_purpose" style="display:none;">
                      @endif
                    </div>
                    <div class="col-sm-3 form-query">
                      <label for="inputName" class="col-form-label">Start Date<font style="color:red">*</font> </label>
                      <input type="text" name="start_date" class="form-control form-control-sm singledatepicker" id="inputName" placeholder="Enter start Date" value="{{@$editData->start_date}}" autocomplete="off">

                      @if($errors->has('start_date'))
                        <strong class="text-danger">{{$errors->first('start_date')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-3 form-query">
                      <label for="inputName" class="col-form-label">End Date<font style="color:red">*</font> </label>
                      <input type="text" name="end_date" class="form-control form-control-sm singledatepicker" id="inputName" placeholder="Enter end Date" value="{{@$editData->end_date}}" autocomplete="off">
                      @if($errors->has('end_date'))
                        <strong class="text-danger">{{$errors->first('end_date')}}</strong>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger btn-sm">{{(@$editData) ? 'Update' : 'Submit'}}</button>
                    </div>
                  </div>
                </form>
            </div>
          </div><!-- /.card-body -->
        </div>
      </section>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection
@push('js')
<script type="text/javascript">

  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  }
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#myForm').validate({
      rules:{
        "employee_id":{
          required:true,
        },
        "leave_purposes_id":{
          required:true,
        },
        "new_purpose":{
          required:true,
        },
        "start_date":{
          required:true,
        },
        "end_date":{
          required:true,
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
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','#leave_purposes_id',function(){
      var leave_purposes_id = $(this).val();
      if(leave_purposes_id == '0'){
        $('#new_purpose').show();
      }else {
        $('#new_purpose').hide();
      }
    })
  })
</script>
@endpush
