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
class EmployeeRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $allemployee = user::where('usertype','employee')->get();
      return view('backend.Employee.Registration.index',compact('allemployee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $designation = Designation::all();
      return view('backend.Employee.Registration.create',compact('designation'));
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
      DB::transaction(function()use($request){

          $checkJoinDate = date('Ym',strtotime($request->join_date));
          // dd($checkJoinDate);
          $employee = User::where('usertype','employee')->orderBy('id','DESC')->first();
          if($employee==null){
            $firstReg = 0;
            $employeeId = $firstReg+1;
            if($employeeId<10){
              $id_no = '000'.$employeeId;
            }elseif ($employeeId<100) {
              $id_no = '00'.$employeeId;
            }elseif ($employeeId<1000) {
              $id_no = '0'.$employeeId;
            }
          }else {
            $employee = User::where('usertype','employee')->orderBy('id','DESC')->first()->id;
            $employeeId=$employee+1;
            if($employeeId<10){
              $id_no='000'.$employeeId;
            }elseif ($employeeId<100) {
              $id_no = '00'.$employeeId;
            }elseif ($employeeId<1000) {
              $id_no = '0'.$employeeId;
            }
          }
          $value = 'wub-';
          $final_id = $value.$checkJoinDate.$id_no;//employee id number


      if($request->hasFile('image')){
            $image=$request->file('image');
            $imageName='employee_image-'.uniqid().'-'.time().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('Employee')){
                Storage::disk('public')->makeDirectory('Employee');
            }
            Image::make($image)->resize(150,150)->save(public_path('storage/Employee/'.$imageName));
          }else{
            $imageName="default.png";
          }
//password auto generate
          $code = rand(000000,999999);


          $user = new User();
          $user->name=$request->name;
          $user->id_no=$final_id;
          $user->fname=$request->fname;
          $user->mname=$request->mname;
          $user->usertype='employee';
          $user->email=$request->email;
          $user->password=bcrypt($code);
          $user->mobile=$request->mobile;
          $user->address=$request->address;
          $user->gender=$request->gender;
          $user->image=$imageName;
          $user->religion=$request->religion;
          $user->dob= date('Y-m-d',strtotime($request->dob));
          $user->join_date= date('Y-m-d',strtotime($request->join_date));
          $user->designation_id=$request->designation_id;
          $user->salary=$request->salary;
          $user->code=$code;
          $user->role_id='2';
          $user->save();

//employee salary log table
          $employee_salary = new EmployeSalaryLog();
          $employee_salary->employee_id=$user->id;
          $employee_salary->previous_salary=$request->salary;
          $employee_salary->present_salary=$request->salary;
          $employee_salary->increment_salary='0';
          $employee_salary->effected_date=date('Y-m-d',strtotime($request->dob));
          $employee_salary->save();

        });
          Toastr::info('Success', 'Data Store Successfuly Done');
          return redirect()->route('employee-registration.index')->with('Success','Data store Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['details']=User::find($id);
        // dd($allEmployee->toArray());
        $pdf = PDF::loadView('backend.Employee.Registration.employee-information-pdf',$data);
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
      $designation = Designation::all();
      $editData=User::find($id);
      return view('backend.Employee.Registration.create',compact('designation','editData'));
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

      $image=$request->file('image');
      if(isset($image)){

        $imageName='employee_image_update'.uniqid().'-'.time().'.'.$image->getClientOriginalExtension();

        if(!Storage::disk('public')->exists('Employee')){
          Storage::disk('public')->makeDirectory('Employee');
        }
        if(Storage::disk('public')->exists('Employee/'.$user->image)){
          Storage::disk('public')->delete('Employee/'.$user->image);
        }
        Image::make($image)->resize(150,160)->save(public_path('storage/Employee/'.$imageName));
      }else{
        $imageName=$user->image;
      }

          $user->name=$request->name;
          $user->fname=$request->fname;
          $user->mname=$request->mname;
          $user->email=$request->email;
          $user->mobile=$request->mobile;
          $user->address=$request->address;
          $user->gender=$request->gender;
          $user->image=$imageName;
          $user->religion=$request->religion;
          $user->dob= date('Y-m-d',strtotime($request->dob));
          $user->designation_id=$request->designation_id;
          $user->save();
          Toastr::info('Success', 'Data Update Successfuly Done');
          return redirect()->route('employee-registration.index')->with('Success','Data Update Successfuly');
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
