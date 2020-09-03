@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Employee Attendace')
@push('css')
<!-- DataTables -->
 <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet" href="{{asset('public/backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
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
              Employee Attendace List
            </h3>
            <div class="card-tools">
              <ul class="nav nav-pills ml-auto">
                <li class="nav-item">
                  <a class="nav-link active" href="{{route('employee-attendance.create')}}"><i class="fa fa-plus-circle"></i>Take Employee Attendace</a>
                </li>
              </ul>
            </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="control-label">Date</label>
                <input type="text" name="date" id="date" class="form-control form-control-sm singledatepicker" autocomplete="off" readonly>
              </div>
              <div class="form-group col-md-2">
                <input type="submit" class="btn btn-sm btn-success" id="search" style="margin-top:29px;color:white;">
              </div>
            </div>
          </div><!-- /.card-body -->
        </div>
        <div class="card-body">
          <div id="DocumentResults"></div>
          <script id="document-template" type="text/x-handlebars-template">
            <table class="table-sm table-bordered table-striped" style="width:100%">
              <thead>
                <tr>
                  @{{{thsource}}}
                </tr>
              </thead>
              <tbody>
                @{{#each this}}
                <tr>
                  @{{{tdsource}}}
                </tr>
                @{{/each}}
              </tbody>
            </table>
          </script>
        </div>
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
<script src="{{asset('public/backend')}}/dist/js/handlebars-v4.0.12.js"></script>
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
<!--handlebars js--->
<script>
  $(document).on('click','#search',function(){
    var date = $('#date').val();
    $('.toastr').html('');
    if(date==''){
      toastr.error("Date required",{className:'error'});
      return false;
    }

    $.ajax({
      url:"{{route('employee-monthly-salary.create')}}",
      type:"get",
      data:{'date': date},
      beforeSend: function(){

      },
      success:function(data){
        var source = $("#document-template").html();
        var template = Handlebars.compile(source);
        var html = template(data);
        console.log(html);
        $('#DocumentResults').html(html);
        $('[data-toggle="tooltip"]').tooltip();
      }
    });
  });
</script>
<!--sweet alert--->
<script type="text/javascript">
          function studentClass(id) {
            const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false,
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
    event.preventDefault();
    document.getElementById('destroy-'+id).submit();
  } else if (
    // Read more about handling dismissals
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
          }
   </script>
@endpush
