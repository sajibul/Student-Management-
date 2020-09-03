<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Model\StudentRegistration;
use App\Model\DiscoutStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShit;
use App\Model\StudentYear;
use App\Model\EmployeSalaryLog;
use App\Model\Designation;
use App\Model\LeavePurpose;
use App\Model\EmployeeLeave;
use App\Model\EmployeeAttendance;
use App\User;
use Storage;
use Image;
use DB;
use PDF;
class EmployeeMonthlySalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('backend.Employee.MonthlySalary.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $date = date('Y-m', strtotime($request->date));
      if($date !=''){
        $where[] = ['date','like',$date.'%'];
      }
      $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['employee'])->where($where)->get();
      $html['thsource'] = '<th>SL</th>';
      $html['thsource'] .= '<th>Employee Name</th>';
      $html['thsource'] .= '<th>Basic Salary</th>';
      $html['thsource'] .= '<th>Salary(This month)</th>';
      $html['thsource'] .= '<th>Action</th>';

      foreach($data as $key=> $attend){
        $totalAttend = EmployeeAttendance::with(['employee'])->where($where)->where('employee_id',$attend->employee_id)->get();
        $absentCount = count($totalAttend->where('attendance_status','Absent'));
        $color = 'success';
        $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
        $html[$key]['tdsource'] .='<td>'.$attend['employee']['name'].'</td>';
        $html[$key]['tdsource'] .='<td>'.$attend['employee']['salary'].'</td>';
        $salary = (float)$attend['employee']['salary'];
        $salaryPerDay = (float)$salary/30;
        $totalsalaryminus = (float)$absentCount*(float)$salaryPerDay;
        $totalsalary =(float)$salary-(float)$totalsalaryminus;
        $html[$key]['tdsource'] .='<td>'.$totalsalary.'</td>';
        $html[$key]['tdsource'] .='<td>';
        $html[$key]['tdsource'] .='<a class="btn btn-sm btn-'.$color.'" title="Payslip" target="_blank" href="'.route("employee-monthly-salary.show",$attend->employee_id).'">Payslip</a>';
        $html[$key]['tdsource'] .='</td>';
      }
      return response()->json(@$html);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $employee_id)
    {
      $id = EmployeeAttendance::where('employee_id',$employee_id)->first();
      // dd($id->toArray());
      $date = date('Y-m',strtotime($id->date));
      if($date !=''){
        $where[] = ['date','like',$date.'%'];
      }
      $data['details'] = EmployeeAttendance::with(['employee'])->where($where)->where('employee_id',$id->employee_id)->get();
      $pdf = PDF::loadView('backend.Employee.MonthlySalary.monthlySalaryPdf',$data);
      $pdf->SetProtection(['copy', 'print'], '', 'pass');
      return $pdf->stream('payslip.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
