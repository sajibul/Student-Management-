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
class EmployeeAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $allatendance = EmployeeAttendance::select('date')->groupBy('date')->latest()->get();
      return view('backend.Employee.EmpAttendance.index',compact('allatendance'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $allemployee  = User::where('usertype','employee')->latest()->get();
        // $allatendance = EmployeeAttendance::latest()->get();
      return view('backend.Employee.EmpAttendance.create',compact('allemployee'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
        'date'=>'required|unique:employee_attendances,date',
      ],[

      ]);

      $countemployee = count($request->employee_id);
      for($i=0; $i<$countemployee;$i++){
        $attendance_status = 'attend_status'.$i;
        $atten = new EmployeeAttendance();
        $atten->date = date('Y-m-d',strtotime($request->date));
        $atten->employee_id=$request->employee_id[$i];
        $atten->attendance_status =$request->$attendance_status;
        $atten->save();
      }
      Toastr::info('Success', 'Data Store Successfuly Done');
      return redirect()->route('employee-attendance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($date)
    {
      $allemployee  = User::where('usertype','employee')->latest()->get();
        $editData = EmployeeAttendance::where('date',$date)->get();
      return view('backend.Employee.EmpAttendance.create',compact('editData','allemployee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $date)
    {

        EmployeeAttendance::where('date',date('Y-m-d',strtotime($request->date)))->delete();
        $countemployee = count($request->employee_id);
      for($i=0; $i<$countemployee;$i++){
        $attendance_status = 'attend_status'.$i;
        $atten = new EmployeeAttendance();
        $atten->date = date('Y-m-d',strtotime($request->date));
        $atten->employee_id=$request->employee_id[$i];
        $atten->attendance_status =$request->$attendance_status;
        $atten->save();
      }
      Toastr::info('Success', 'Data Update Successfuly Done');
      return back();
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
