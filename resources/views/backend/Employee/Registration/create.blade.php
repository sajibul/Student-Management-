@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Student')
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
                  <a class="nav-link active" href="{{route('employee-registration.index')}}"><i class="fa fa-th"></i>Employee List</a>
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
                <form class="form-horizontal" id="myForm" action="{{(@$editData) ? route('employee-registration.update',$editData->id) : route('employee-registration.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @if(!empty(@$editData))
                  @method('PUT')
                  @endif
                  <div class="form-group row">
                    <input type="hidden" name="id"  id="id"  value="{{@$editData->id}}">
                    <div class="col-sm-4 form-query">
                      <label for="inputName" class="col-form-label">Employee Name <font style="color:red">*</font> </label>
                      <input type="text" name="name" class="form-control form-control-sm" id="name"  value="{{@$editData->name}}">
                      @if($errors->has('name'))
                        <strong class="text-danger">{{$errors->first('name')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4 form-query">
                      <label for="inputName" class="col-form-label">Father's Name <font style="color:red">*</font> </label>
                      <input type="text" name="fname" class="form-control form-control-sm" id="inputName" placeholder="Enter Father's Name" value="{{@$editData->fname}}">
                      @if($errors->has('fname'))
                        <strong class="text-danger">{{$errors->first('fname')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4 form-query">
                      <label for="inputName" class="col-form-label">Mother's Name <font style="color:red">*</font> </label>
                      <input type="text" name="mname" class="form-control form-control-sm" id="inputName" placeholder="Enter Mother's Name" value="{{@$editData->mname}}">
                      @if($errors->has('mname'))
                        <strong class="text-danger">{{$errors->first('mname')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4 form-query">
                      <label for="inputName" class="col-form-label">Mobile Number <font style="color:red">*</font> </label>
                      <input type="text" name="mobile" class="form-control form-control-sm" id="inputName" placeholder="Enter Mobile Number" value="{{@$editData->mobile}}">
                      @if($errors->has('mobile'))
                        <strong class="text-danger">{{$errors->first('mobile')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4 form-query">
                      <label for="inputName" class="col-form-label">Email <font style="color:red">*</font> </label>
                      <input type="text" name="email" class="form-control form-control-sm" id="inputName" placeholder="Enter Email" value="{{@$editData->email}}">
                      @if($errors->has('email'))
                        <strong class="text-danger">{{$errors->first('email')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4 form-query">
                      <label for="inputName" class="col-form-label">Address <font style="color:red">*</font> </label>
                      <input type="text" name="address" class="form-control form-control-sm" id="inputName" placeholder="Enter address" value="{{@$editData->address}}">
                      @if($errors->has('address'))
                        <strong class="text-danger">{{$errors->first('address')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-3 form-query">
                      <label for="inputName" class="col-form-label">Gender <font style="color:red">*</font> </label>
                      <select class="form-control select2 form-control-sm" style="width: 100%;" name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male" {{(@$editData->gender=='Male') ? 'selected' : ''}}>Male</option>
                        <option value="Female" {{(@$editData->gender=='Female') ? 'selected' : ''}}>Female</option>
                      </select>
                      @if($errors->has('gender'))
                        <strong class="text-danger">{{$errors->first('gender')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-3 form-query">
                      <label for="inputName" class="col-form-label">Religion <font style="color:red">*</font> </label>
                      <select class="form-control select2 form-control-sm" style="width: 100%;" name="religion">
                        <option value="">Select Religion</option>
                        <option value="Muslim" {{(@$editData->religion=='Muslim') ? 'selected' : ''}}>Muslim</option>
                        <option value="Hindu" {{(@$editData->religion=='Hindu') ? 'selected' : ''}}>Hindu</option>
                        <option value="Khristan" {{(@$editData->religion=='Khristan') ? 'selected' : ''}}>Khristan</option>
                      </select>
                      @if($errors->has('religion'))
                        <strong class="text-danger">{{$errors->first('religion')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-3 form-query">
                      <label for="inputName" class="col-form-label">Date of Birth <font style="color:red">*</font> </label>
                      <input type="text" name="dob" class="form-control form-control-sm singledatepicker" id="inputName" placeholder="Enter Date of Birth" value="{{@$editData->dob}}" autocomplete="off">

                      @if($errors->has('dob'))
                        <strong class="text-danger">{{$errors->first('dob')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-3 form-query">
                      <label for="inputName" class="col-form-label">Designation <font style="color:red">*</font> </label>
                      <select class="form-control select2 form-control-sm" style="width: 100%;" name="designation_id">
                        <option value="">Select Designation</option>
                        @foreach($designation as $data)
                        <option value="{{$data->id}}" {{(@$editData->designation_id==$data->id) ? 'selected' : ''}}>{{$data->name}}</option>
                        @endforeach
                      </select>
                      @if($errors->has('designation_id'))
                        <strong class="text-danger">{{$errors->first('designation_id')}}</strong>
                      @endif
                    </div>
                    @if(!@$editData)
                    <div class="col-sm-3 form-query">
                      <label for="inputName" class="col-form-label">Salary <font style="color:red">*</font> </label>
                      <input type="text" name="salary" class="form-control form-control-sm" id="inputName" placeholder="Enter salary" value="{{@$editData->salary}}">
                      @if($errors->has('salary'))
                        <strong class="text-danger">{{$errors->first('salary')}}</strong>
                      @endif
                    </div>
                    @endif
                    @if(!@$editData)
                    <div class="col-sm-3 form-query">
                      <label for="inputName" class="col-form-label">Join Date<font style="color:red">*</font> </label>
                      <input type="text" name="join_date" class="form-control form-control-sm singledatepicker" id="inputName" placeholder="Enter join Date" value="{{@$editData->join_date}}" autocomplete="off">

                      @if($errors->has('join_date'))
                        <strong class="text-danger">{{$errors->first('join_date')}}</strong>
                      @endif
                    </div>
                    @endif
                    <div class="col-sm-3 form-query">
                      <label for="exampleInputFile">Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image"  id="image"  class="custom-file-input " id="exampleInputFile" onchange="loadFile(event)">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                      @if($errors->has('image'))
                        <strong class="text-danger">{{$errors->first('image')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-3 form-query">
                      <img  id="output" class="img-fluid"
                            src="{{!empty($editData->image) ? url('public/storage/Employee/'.$editData->image) : asset('public/backend/dist/img/empty.jpg') }}"
                           alt="User profile picture" style="width:100px;height:120px;border:1px solid #000;margin-top:8px;">
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
        "name":{
          required:true,
        },
        "fname":{
          required:true,
        },
        "mname":{
          required:true,
        },
        "mobile":{
          required:true,
        },
        "email":{
          required:true,
        },
        "address":{
          required:true,
        },
        "gender":{
          required:true,
        },
        "religion":{
          required:true,
        },
        "dob":{
          required:true,
        },
        "designation_id":{
          required:true,
        },
        "salary":{
          required:true,
        },
        "join_date":{
          required:true,
        },
        @if(!@$editData)
        "image":{
          required:true,
        },
        @endif
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
