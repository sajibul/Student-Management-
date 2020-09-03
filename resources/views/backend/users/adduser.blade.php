@extends('layouts.dashboard')

@section('content')
@section('tittle','Add Users')
@push('css')
<!-- DataTables -->

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
              Add User
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('user-information.index')}}"><i class="fa fa-th"></i>All User</a>
                </li>
              </ul>
            </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <form class="" action="{{route('user-information.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
                  <div class="row">
                         <div class="col-md-4">
                           <div class="form-group">
                             <label>User Role</label>
                             <select class="form-control select2" style="width: 100%;" name="role">
                               <option selected="selected" disabled>--select Role--</option>
                               @foreach($role as $roleInfo)
                               <option value="{{$roleInfo->id}}">{{$roleInfo->role_name}}</option>
                               @endforeach
                             </select>
                             @if($errors->has('role'))
                              <span class="text-danger">{{$errors->first('role')}}</span>
                             @endif
                           </div>
                         </div>
                         <div class="col-md-4">
                           <div class="form-group">
                             <label>Name</label>
                             <input class="form-control" type="text" name="name" placeholder="Enter name">
                             @if($errors->has('name'))
                              <span class="text-danger">{{$errors->first('name')}}</span>
                             @endif
                           </div>
                         </div>
                         <div class="col-md-4">
                           <div class="form-group">
                             <label>UserName</label>
                             <input class="form-control" type="text" name="username" placeholder="Enter username">
                             @if($errors->has('username'))
                              <span class="text-danger">{{$errors->first('username')}}</span>
                             @endif
                           </div>
                         </div>
                         <div class="col-md-4">
                           <div class="form-group">
                             <label>Email</label>
                             <input class="form-control" type="email" name="email" placeholder="Enter email">
                             @if($errors->has('email'))
                              <span class="text-danger">{{$errors->first('email')}}</span>
                             @endif
                           </div>
                         </div>
                         <div class="col-md-4">
                           <div class="form-group">
                             <label>Phone</label>
                             <input class="form-control" type="numeric" name="phone" placeholder="Enter phone">
                             @if($errors->has('phone'))
                              <span class="text-danger">{{$errors->first('phone')}}</span>
                             @endif
                           </div>
                         </div>
                         <div class="col-md-4">
                           <div class="form-group">
                             <label>Address</label>
                             <input class="form-control" type="text" name="address" placeholder="Enter address">
                             @if($errors->has('address'))
                              <span class="text-danger">{{$errors->first('address')}}</span>
                             @endif
                           </div>
                         </div>
                         <div class="col-md-4">
                           <div class="form-group">
                             <label>Password</label>
                             <input class="form-control" type="password" name="password" placeholder="Enter your password">
                             @if($errors->has('password'))
                              <span class="text-danger">{{$errors->first('password')}}</span>
                             @endif
                           </div>
                         </div>
                         <div class="col-md-4">
                           <div class="form-group">
                             <label>Confirm Password</label>
                             <input class="form-control" type="password"  name="password_confirmation" placeholder="Enter Confirm password">
                             @if($errors->has('password_confirmation'))
                              <span class="text-danger">{{$errors->first('password_confirmation')}}</span>
                             @endif
                           </div>
                         </div>
                         <div class="col-md-4">
                           <div class="form-group">
                             <label>Image</label>
                             <input class="form-control" type="file" name="image"  onchange="loadFile(event)" required>
                             @if($errors->has('image'))
                              <span class="text-danger">{{$errors->first('image')}}</span>
                             @endif
                           </div>
                         </div>
                         <div class="col-md-4">
                           <div class="form-group">
                             <img  id="output" class="img-fluid"
                                  src="" alt="" style="width:100px;height:120px;border:1px solid #000;">
                           </div>
                         </div>
                         <!-- /.col -->
                       </div>
                       <!-- /.row -->
          </div><!-- /.card-body -->
          <div class="card-footer text-center">
            <button class="btn btn-sm btn-primary">REGISTRATION</button>
          </div>
        </form>
        </div>
      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
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
