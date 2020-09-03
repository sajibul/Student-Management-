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
              Promotion Student
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('registration-student.index')}}"><i class="fa fa-th"></i>Students List</a>
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
                <form class="form-horizontal" id="myForm" action="{{route('store-promotion-student',$editData->student_id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group row">
                    <input type="hidden" name="id"  id="id"  value="{{@$editData->id}}">
                    <div class="col-sm-4">
                      <label for="inputName" class="col-form-label">Student Name</label>
                      <input type="text" name="name" class="form-control form-control-sm" id="name" placeholder="Enter Student Name" value="{{@$editData->user->name}}">
                      @if($errors->has('name'))
                        <strong class="text-danger">{{$errors->first('name')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4">
                      <label for="inputName" class="col-form-label">Father's Name</label>
                      <input type="text" name="fname" class="form-control form-control-sm" id="inputName" placeholder="Enter Father's Name" value="{{@$editData->user->fname}}">
                      @if($errors->has('fname'))
                        <strong class="text-danger">{{$errors->first('fname')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4">
                      <label for="inputName" class="col-form-label">Mother's Name </label>
                      <input type="text" name="mname" class="form-control form-control-sm" id="inputName" placeholder="Enter Mother's Name" value="{{@$editData->user->mname}}">
                      @if($errors->has('mname'))
                        <strong class="text-danger">{{$errors->first('mname')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4">
                      <label for="inputName" class="col-form-label">Mobile Number</label>
                      <input type="text" name="mobile" class="form-control form-control-sm" id="inputName" placeholder="Enter Mobile Number" value="{{@$editData->user->mobile}}">
                      @if($errors->has('mobile'))
                        <strong class="text-danger">{{$errors->first('mobile')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4">
                      <label for="inputName" class="col-form-label">Address </label>
                      <input type="text" name="address" class="form-control form-control-sm" id="inputName" placeholder="Enter address" value="{{@$editData->user->address}}">
                      @if($errors->has('address'))
                        <strong class="text-danger">{{$errors->first('address')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4">
                      <label for="inputName" class="col-form-label">Gender</label>
                      <select class="form-control select2 form-control-sm" style="width: 100%;" name="gender">
                        <option value="">Select Gender</option>
                        <option value="Male" {{(@$editData->user->gender=='Male') ? 'selected' : ''}}>Male</option>
                        <option value="Female" {{(@$editData->user->gender=='Female') ? 'selected' : ''}}>Female</option>
                      </select>
                      @if($errors->has('gender'))
                        <strong class="text-danger">{{$errors->first('gender')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4">
                      <label for="inputName" class="col-form-label">Religion</label>
                      <select class="form-control select2 form-control-sm" style="width: 100%;" name="religion">
                        <option value="">Select Religion</option>
                        <option value="Muslim" {{(@$editData->user->religion=='Muslim') ? 'selected' : ''}}>Muslim</option>
                        <option value="Hindu" {{(@$editData->user->religion=='Hindu') ? 'selected' : ''}}>Hindu</option>
                        <option value="Khristan" {{(@$editData->user->religion=='Khristan') ? 'selected' : ''}}>Khristan</option>
                      </select>
                      @if($errors->has('religion'))
                        <strong class="text-danger">{{$errors->first('religion')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4">
                      <label for="inputName" class="col-form-label">Date of Birth</label>
                      <input type="text" name="dob" class="form-control form-control-sm singledatepicker" id="inputName" placeholder="Enter Date of Birth" value="{{@$editData->user->dob}}" autocomplete="off">

                      @if($errors->has('dob'))
                        <strong class="text-danger">{{$errors->first('dob')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4">
                      <label for="inputName" class="col-form-label">Discount <font style="color:red">*</font> </label>
                      <input type="text" name="discount" class="form-control form-control-sm" id="inputName" placeholder="Enter Discount" value="{{@$editData->discount_stu->discount}}">
                      @if($errors->has('discount'))
                        <strong class="text-danger">{{$errors->first('discount')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4">
                      <label for="inputName" class="col-form-label">Class <font style="color:red">*</font> </label>
                      <select class="form-control select2 form-control-sm" style="width: 100%;" name="class_id">
                        <option value="">Select class</option>
                        @foreach($classes as $class)
                        <option value="{{$class->id}}" {{(@$editData->class_id==$class->id) ? 'selected' : ''}}>{{$class->name}}</option>
                        @endforeach
                      </select>
                      @if($errors->has('class_id'))
                        <strong class="text-danger">{{$errors->first('class_id')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4">
                      <label for="inputName" class="col-form-label">Year <font style="color:red">*</font> </label>
                      <select class="form-control select2 form-control-sm" style="width: 100%;" name="year_id">
                        <option value="">Select Year</option>
                        @foreach($yeares as $year)
                        <option value="{{$year->id}}" {{(@$editData->year_id==$year->id) ? 'selected' : ''}}>{{$year->year_name}}</option>
                        @endforeach
                      </select>
                      @if($errors->has('year_id'))
                        <strong class="text-danger">{{$errors->first('year_id')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4">
                      <label for="inputName" class="col-form-label">Group</label>
                      <select class="form-control select2 form-control-sm" style="width: 100%;" name="group_id">
                        <option value="">Select Group</option>
                        @foreach($groupes as $group)
                        <option value="{{$group->id}}" {{(@$editData->group_id==$group->id) ? 'selected' : ''}}>{{$group->name}}</option>
                        @endforeach
                      </select>
                      @if($errors->has('group_id'))
                        <strong class="text-danger">{{$errors->first('group_id')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4">
                      <label for="inputName" class="col-form-label">Shift</label>
                      <select class="form-control select2 form-control-sm" style="width: 100%;" name="shift_id">
                        <option value="">Select Shift</option>
                        @foreach($shiftes as $shift)
                        <option value="{{$shift->id}}" {{(@$editData->shift_id==$shift->id) ? 'selected' : ''}}>{{$shift->name}}</option>
                        @endforeach
                      </select>
                      @if($errors->has('shift_id'))
                        <strong class="text-danger">{{$errors->first('shift_id')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4">
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
                    <div class="col-sm-4">
                      <img  id="output" class="img-fluid"
                            src="{{!empty($editData->user->image) ? url('public/storage/students/'.$editData->user->image) : asset('public/backend/dist/img/empty.jpg') }}"
                           alt="User profile picture" style="width:100px;height:120px;border:1px solid #000;margin-top:8px;">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger btn-sm">Promotion</button>
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

@endpush
