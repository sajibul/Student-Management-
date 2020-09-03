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
use App\User;
use Storage;
use Image;
use DB;
use PDF;
class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $allemployee = user::where('usertype','employee')->get();
      // dd($allemployee->toArray());
      return view('backend.Employee.Salary.index',compact('allemployee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $details=User::find($id);
      $salaryLog=EmployeSalaryLog::where('employee_id',$details->id)->get();
      // dd($allEmployee->toArray());
      $pdf = PDF::loadView('backend.Employee.Salary.increment-salary-pdf',compact('details','salaryLog'));
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
       $editData=User::find($id);
       return view('backend.Employee.Salary.increment-employee-salary',compact('editData'));
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

        $user = User::find($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary+(float)$request->increment_salary;
        $user->salary=$present_salary;
        $user->save();

        $salaryData = new EmployeSalaryLog();
        $salaryData->employee_id=$id;
        $salaryData->previous_salary=$previous_salary;
        $salaryData->present_salary=$present_salary;
        $salaryData->increment_salary=$request->increment_salary;
        $salaryData->effected_date=  date('Y-m-d',strtotime($request->effected_date));
        $salaryData->save();
        return redirect()->route('employee-salary.index')->with('Success','Data store Successfuly');
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
