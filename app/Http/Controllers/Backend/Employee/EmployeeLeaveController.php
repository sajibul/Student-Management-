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
use App\User;
use Storage;
use Image;
use DB;
use PDF;
class EmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allemployee=EmployeeLeave::latest()->get();
        return view('backend.Employee.Leave.index',compact('allemployee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $allemployee = User::where('usertype','employee')->get();
      $purpose = LeavePurpose::all();
      return view('backend.Employee.Leave.create',compact('allemployee','purpose'));
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

      ],[

      ]);
      if($request->leave_purposes_id == '0'){
        $leavePurpose = new LeavePurpose();
        $leavePurpose->name = $request->name;
        $leavePurpose->save();
        $leave_purpose_id = $leavePurpose->id;
      }else {
        $leave_purpose_id =  $request->leave_purposes_id;
      }
        $data = new EmployeeLeave();
        $data->employee_id=$request->employee_id;
        $data->leave_purposes_id=$leave_purpose_id;
        $data->start_date= date('Y-m-d',strtotime($request->start_date));
        $data->end_date=  date('Y-m-d',strtotime($request->end_date));
        $data->save();
          Toastr::info('Success', 'Data Store Successfuly Done');
        return redirect()->route('employee-leave.index')->with('Success','Data submit successfuly');


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
    public function edit($id)
    {
        $allemployee = User::where('usertype','employee')->get();
        $purpose = LeavePurpose::all();
        $editData = EmployeeLeave::find($id);
        return view('backend.Employee.Leave.create',compact('allemployee','purpose','editData'));
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
      $this->validate($request,[

      ],[

      ]);

        $data =  EmployeeLeave::find($id);
        $data->employee_id=$request->employee_id;
        $data->leave_purposes_id=$request->leave_purposes_id;
        $data->start_date= date('Y-m-d',strtotime($request->start_date));
        $data->end_date=  date('Y-m-d',strtotime($request->end_date));
        $data->save();
          Toastr::info('Success', 'Data Update Successfuly Done');
        return redirect()->route('employee-leave.index')->with('Success','Data update successfuly');
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
