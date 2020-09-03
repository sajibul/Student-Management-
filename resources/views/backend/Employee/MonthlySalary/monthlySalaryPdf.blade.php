<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <title>Employee Monthly Salary Recet</title>
      <style type="text/css">
        table{
          border-collapse: collapse;;
        }
        h2,h3{
          margin: 0;
          padding: 0;
        }
        .table{
          width: 100%;
          margin-bottom: 1rem;
          background-color: transparent;
        }
        .table th,
        .table td{
          padding: 0.75rem;
          vertical-align: top;
          border-top: 1px solid #dee2e6;
        }
        .table thead th{
          vertical-align: bottom;
          border-bottom: 2px solid #dee2e6;
        }
        .table tbody + tbody{
          border-top: 2px solid #dee2e6;
        }
        .table .table{
          background-color: #fff;
        }
        .table-bordered{
          border: 1px solid #dee2e6;
        }
        .table-bordered th,
        .table-bordered td{
          border:1px solid #dee2e6;
        }
        .table-bordered thead th,
        .table-bordered thead td{
          border-bottom-width: 2px;
        }
        .text-center{
          text-align: center;
        }
        .text-right{
          text-align: right;
        }
        table tr td{
          padding: 5px;
        }
        .table-bordered thead th, .table-bordered td, .table-bordered th{
          border: 1px solid black !important;
        }
        .table-bordered thead th{
          background-color: #cacaca;
        }
      </style>
  </head>
  <body>
<div class="container">
  @php
  $date = date('Y-m',strtotime($details[0]->date));
  if($date !=''){
    $where[]=['date','like',$date.'%'];
  }
  $totalattend = App\Model\EmployeeAttendance::with(['employee'])->where($where)->where('employee_id',$details['0']->employee_id)->get();
  $singleSalary = (float)$details->first()->employee->salary;
  $salaryperday = (float)$singleSalary/30;
  $absentCount = count($totalattend->where('attendance_status','Absent'));
  $totalsalaryminus = (int)$absentCount*(float)$salaryperday;
  $totalsalary = (float)$singleSalary-(float)$totalsalaryminus;

  @endphp
  <div class="row">
    <div class="col-md-12">
      <table width="80%" cellpadding="0" cellspacing="0" padding="0">
        <tr>
          <td width="33%" height="90px" class="text-center"><img src="{{asset('public/backend/dist/img/school-logo.png')}}" alt="img" style="width:100px;height:90px;"> </td>
          <td class="text-center" width="63%" height="90px">
            <h4><strong>School Management</strong></h4>
            <h5><strong>Shibpur, Nabinagar,Brahmanbaria</strong></h5>
            <h6><strong>www.school@gmail.com</strong></h6>
          </td>
          <td class="text-center" height="90px"><img
            src="{{!empty($details[0]['employee']['image']) ? url('public/storage/Employee/'.$details[0]['employee']->image) : asset('public/backend/dist/img/empty.jpg') }}"
            alt="pic" style="width:90px"></td>
        </tr>
      </table>
    </div>
    <div class="col-md-12 text-center">
      <h5 style="font-weight:bold;padding-top:-25px">Employee Monthly Salary</h5>
  </div>
  <div class="col-md-12">

    <table border="1" width="100%">
      <tbody>
        <tr>
          <td style="width:50%">Name</td>
          <td>{{$details[0]->employee->name}}</td>
        </tr>
        <tr>
          <td style="width:50%">Month</td>
          <td>{{date('M-Y',strtotime($details[0]->date))}}</td>
        </tr>
        <tr>
          <td style="width:50%">Basic Salary</td>
          <td>{{$details[0]->employee->salary}}</td>
        </tr>
        <tr>
          <td style="width:50%">Total Absent(For this month)</td>
          <td>{{$absentCount}}</td>
        </tr>
        <tr>
          <td style="width:50%">Salary(This Month)</td>
          <td>{{$totalsalary}}</td>
        </tr>
      </tbody>
    </table>
    <i style="font-size:10px;float:right;">Print Date: {{date('d M Y')}}</i>
  </div> </br>
    <div class="col-md-12">
      <table border="0" width="100%">
        <tbody>
          <tr>
            <td style="width:30%"></td>
            <td style="width:30%"></td>
            <td style="width:40%;text-align:center">
            <hr style="border:solid 1px; width:60%;color:#000;margin-bottom:0px;">
              <p style="text-align:center">Principal/Headmaster</p>
          </td>
          </tr>
        </tbody>
      </table>
    </div>
    </div>
    <hr style="border:dashed 1px; width:96%;color:#DDD;margin-bottom:50px;">

    </div>
  </body>
</html>
