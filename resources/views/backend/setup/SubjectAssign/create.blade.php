@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Assign Subject')
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
              Create Assign Subject
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('assign-subject.index')}}"><i class="fa fa-th"></i>Assign Subject List</a>
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
                <form class="form-horizontal" action="{{route('assign-subject.store')}}" method="post" enctype="multipart/form-data" id="myForm">
                  @csrf
                  <div class="add_item">
                    <div class="form-row">
                      <div class="form-group col-sm-10">
                        <label for="">Class Name</label>
                        <select class="form-control select2" style="width: 100%;" name="class_id">
                          <option selected>--select Class--</option>
                          @foreach($allclass as $class)
                          <option value="{{$class->id}}">{{$class->name}}</option>
                          @endforeach
                        </select>
                        @if($errors->has('class_id'))
                         <span class="text-danger">{{$errors->first('class_id')}}</span>
                        @endif
                      </div>
                      </div>
                      <div class="form-row">
                      <div class="form-group col-sm-3">
                        <label for="">Subject Name</label>
                        <select class="form-control select2" style="width: 100%;" name="subject_id[]">
                          <option selected>--select Subject--</option>
                          @foreach($allsubject as $subject)
                          <option value="{{$subject->id}}">{{$subject->name}}</option>
                          @endforeach
                        </select>
                        @if($errors->has('subject_id	'))
                         <span class="text-danger">{{$errors->first('subject_id')}}</span>
                        @endif
                      </div>
                      <div class="form-group col-sm-2">
                        <label for="">Full_Mark</label>
                        <input type="text" name="full_mark[]" class="form-control" id="inputName" placeholder="Enter full_mark" value="">
                        @if($errors->has('full_mark'))
                          <strong class="text-danger">{{$errors->first('full_mark')}}</strong>
                        @endif
                      </div>
                      <div class="form-group col-sm-2">
                        <label for="">Pass_Mark</label>
                        <input type="text" name="pass_mark[]" class="form-control" id="inputName" placeholder="Enter pass_mark" value="">
                        @if($errors->has('pass_mark'))
                          <strong class="text-danger">{{$errors->first('pass_mark')}}</strong>
                        @endif
                      </div>
                      <div class="form-group col-sm-2">
                        <label for="">Subjective_Mark</label>
                        <input type="text" name="subjective_mark[]" class="form-control" id="inputName" placeholder="Enter subjective_mark" value="">
                        @if($errors->has('subjective_mark'))
                          <strong class="text-danger">{{$errors->first('subjective_mark')}}</strong>
                        @endif
                      </div>
                      <div class="form-group col-sm-1" style="padding-top:30px;">
                        <span class="btn btn-success addeventmore"> <i class="fa fa-plus-circle"></i> </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger text-align-center">Submit</button>
                    </div>
                  </div>
                </form>
            </div>
          </div><!-- /.card-body -->
        </div>
    </div>
  </section>
  </div>
  </div><!-- /.container-fluid -->
</section>
<!--for hidden code-->
<div style="visibility:hidden">
  <div class="whole_extra_item_add" id="whole_extra_item_add">
    <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
      <div class="form-row">
        <div class="form-group col-sm-3">
          <label for="">Subject Name</label>
          <select class="form-control select2" style="width: 100%;" name="subject_id[]">
            <option selected>--select Subject--</option>
            @foreach($allsubject as $subject)
            <option value="{{$subject->id}}">{{$subject->name}}</option>
            @endforeach
          </select>
          @if($errors->has('subject_id	'))
           <span class="text-danger">{{$errors->first('subject_id')}}</span>
          @endif
        </div>
        <div class="form-group col-sm-2">
          <label for="">Full_Mark</label>
          <input type="text" name="full_mark[]" class="form-control" id="inputName" placeholder="Enter full_mark" value="">
          @if($errors->has('full_mark'))
            <strong class="text-danger">{{$errors->first('full_mark')}}</strong>
          @endif
        </div>
        <div class="form-group col-sm-2">
          <label for="">Pass_Mark</label>
          <input type="text" name="pass_mark[]" class="form-control" id="inputName" placeholder="Enter pass_mark" value="">
          @if($errors->has('pass_mark'))
            <strong class="text-danger">{{$errors->first('pass_mark')}}</strong>
          @endif
        </div>
        <div class="form-group col-sm-2">
          <label for="">Subjective_Mark</label>
          <input type="text" name="subjective_mark[]" class="form-control" id="inputName" placeholder="Enter subjective_mark" value="">
          @if($errors->has('subjective_mark'))
            <strong class="text-danger">{{$errors->first('subjective_mark')}}</strong>
          @endif
        </div>
        <div class="form-group col-sm-2" style="padding-top:30px;">
          <span class="btn btn-success addeventmore"> <i class="fa fa-plus-circle"></i> </span>
          <span class="btn btn-danger removeeventmore"> <i class="fa fa-minus-circle"></i> </span>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
  <script type="text/javascript">
    $(document).ready(function(){
      var counter = 0;
      $(document).on("click",".addeventmore",function(){
        var whole_extra_item_add = $("#whole_extra_item_add").html();
        $(this).closest(".add_item").append(whole_extra_item_add);
        counter++;
      });
      $(document).on("click",".removeeventmore",function(event){
        $(this).closest(".delete_whole_extra_item_add").remove();
        counter -=1
      });
    });
  </script>
@endpush
