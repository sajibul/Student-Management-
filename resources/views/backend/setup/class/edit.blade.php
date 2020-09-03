

@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Student Class')
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
              <i class="fa fa-plus-circle"></i>
              Edit Student Class
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('class-information.index')}}"><i class="fa fa-th"></i>All Class</a>
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
                <form class="form-horizontal" action="{{route('class-information.update',$data->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Class Name</label>
                    <div class="col-sm-10">
                      <input type="text" name="className" class="form-control" id="inputName" placeholder="Enter class name" value="{{$data->name}}">
                      @if($errors->has('className'))
                        <strong class="text-danger">{{$errors->first('className')}}</strong>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Submit</button>
                    </div>
                  </div>
                </form>
            </div>
          </div><!-- /.card-body -->
        </div>
      </section>
      <!-- right col -->
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection
@push('js')

@endpush
