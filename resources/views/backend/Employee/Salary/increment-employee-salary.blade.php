@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Employee Salary')
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
              Increment Employee Salary
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('employee-salary.index')}}"><i class="fa fa-th"></i>Employee List</a>
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
                <form class="form-horizontal"  id="myForm" action="{{route('employee-salary.update',$editData->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group row">
                    <div class="col-sm-4 form-query">
                      <label for="inputName" class="col-form-label">Salary Amount<font style="color:red">*</font> </label>
                      <input type="text" name="increment_salary" class="form-control form-control-sm" id="inputName"  autocomplete="off">
                      @if($errors->has('increment_salary'))
                        <strong class="text-danger">{{$errors->first('increment_salary')}}</strong>
                      @endif
                    </div>
                    <div class="col-sm-4 form-query">
                      <label for="inputName" class="col-form-label">Effected Date<font style="color:red">*</font> </label>
                      <input type="text" name="effected_date" class="form-control form-control-sm singledatepicker" id="inputName"  value="{{@$editData->effected_date}}" autocomplete="off">
                      @if($errors->has('effected_date'))
                        <strong class="text-danger">{{$errors->first('effected_date')}}</strong>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Update</button>
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
  $(document).ready(function(){
    $('#myForm').validate({
      rules:{
        "increment_salary":{
          required:true,
        },
        "effected_date":{
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
@endpush
