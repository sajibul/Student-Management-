@extends('layouts.dashboard')

@section('content')
@section('tittle','Manage Subject Assign')
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
                            Subject Assign Details
                        </h3>
                        <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{route('assign-subject.index')}}"><i class="fa fa-th"></i>Fee Amount List</a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <h4> <strong>Class :</strong> {{$details[0]->student_class->name}} </h4>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th>Subject</th>
                                    <th>Full Mark</th>
                                    <th>Pass Mark</th>
                                    <th>Subjective_Mark</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($details as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->student_subject->name}}</td>
                                    <td>{{$item->full_mark}}</td>
                                    <td>{{$item->pass_mark}}</td>
                                    <td>{{$item->subjective_mark}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                  <th>Sl.</th>
                                  <th>Subject</th>
                                  <th>Full Mark</th>
                                  <th>Pass Mark</th>
                                  <th>Subjective_Mark</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
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
<script>
    $(function() {
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

@endpush
