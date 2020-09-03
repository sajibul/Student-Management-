@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Designation')
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
              Edit Designation Information
              @else
              Add Designation Information
              @endif
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('designation-information.index')}}"><i class="fa fa-th"></i>Designation List</a>
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
                <form class="form-horizontal" action="{{(@$editData) ? route('designation-information.update',$editData->id) : route('designation-information.store')}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @if(!empty(@$editData))
                  @method('PUT')
                  @endif
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Designation</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" id="inputName" placeholder="Enter Designation" value="{{@$editData->name}}">
                      @if($errors->has('name'))
                        <strong class="text-danger">{{$errors->first('name')}}</strong>
                      @endif
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">{{(@$editData) ? 'Update' : 'Submit'}}</button>
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

@endpush
