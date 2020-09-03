@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Fee Amount')
@push('css')

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
    <i class="fa fa-plus-circle"></i>
    Edit Fee Amount
  </h3>
  <div class="card-tools">
    <ul class="nav nav-pills ml-auto">
      <li class="nav-item">
        <a class="nav-link active" href="{{route('free-amount.index')}}"><i class="fa fa-th"></i>All Fee Amount</a>
      </li>
    </ul>
   </div>
</div>
<div class="card-body">
  <form class="form-horizontal" action="{{route('free-amount.update',$editData[0]->fee_categorie_id)}}" method="post" enctype="multipart/form-data" id="myForm">
    @csrf
    @method('PUT')
<div class="add_item">
<div class="form-row">
  <div class="form-group col-sm-10">
    <label for="">Fee Category</label>
    <select class="form-control select2" style="width: 100%;" name="fee_categorie_id">
      <option selected>--select Fee Category--</option>
      @foreach($allfeecategory as $freecategory)
      <option value="{{$freecategory->id}}" {{($editData[0]->fee_categorie_id==$freecategory->id) ? 'selected' : ''}}>{{$freecategory->name}}</option>
      @endforeach
    </select>
    @if($errors->has('fee_categorie_id'))
     <span class="text-danger">{{$errors->first('fee_categorie_id')}}</span>
    @endif
  </div>
  </div>
@foreach($editData as $data)
<div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
   <div class="form-row">
   <div class="form-group col-sm-5">
     <label for="">Class</label>
     <select class="form-control select2" style="width: 100%;" name="class_id[]">
       <option selected>--select Class--</option>
       @foreach($allclass as $class)
       <option value="{{$class->id}}" {{($data->class_id==$class->id) ? 'selected' : ''}}>{{$class->name}}</option>
       @endforeach
     </select>
     @if($errors->has('class_id	'))
      <span class="text-danger">{{$errors->first('class_id')}}</span>
     @endif
   </div>
   <div class="form-group col-sm-5">
     <label for="">Amount</label>
     <input type="text" name="amount[]" class="form-control" id="inputName" placeholder="Enter Fee amount" value="{{$data->amount}}">
     @if($errors->has('amount'))
       <strong class="text-danger">{{$errors->first('amount')}}</strong>
     @endif
   </div>
   <div class="form-group col-sm-2" style="padding-top:30px;">
     <span class="btn btn-success addeventmore"> <i class="fa fa-plus-circle"></i> </span>
     <span class="btn btn-danger removeeventmore"> <i class="fa fa-minus-circle"></i> </span>
   </div>
 </div>
 </div>
 @endforeach
 </div>
 <div class="form-group row">
   <div class="offset-sm-2 col-sm-10">
     <button type="submit" class="btn btn-danger">Update</button>
   </div>
 </div>
</form>
</div>
</div>
</div>
</div>
</div>
</section>
<!--for hidden code-->
<div style="visibility:hidden">
  <div class="whole_extra_item_add" id="whole_extra_item_add">
    <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
         <div class="form-row">
         <div class="form-group col-sm-5">
           <label for="">Class</label>
           <select class="form-control select2" style="width: 100%;" name="class_id[]">
             <option selected>--select Class--</option>
             @foreach($allclass as $class)
             <option value="{{$class->id}}">{{$class->name}}</option>
             @endforeach
           </select>
           @if($errors->has('class_id	'))
            <span class="text-danger">{{$errors->first('class_id')}}</span>
           @endif
         </div>
         <div class="form-group col-sm-5">
           <label for="">Amount</label>
           <input type="text" name="amount[]" class="form-control" id="inputName" placeholder="Enter Fee amount" value=" ">
           @if($errors->has('amount'))
             <strong class="text-danger">{{$errors->first('amount')}}</strong>
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
