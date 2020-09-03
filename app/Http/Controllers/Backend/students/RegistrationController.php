<?php

namespace App\Http\Controllers\Backend\students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Model\StudentRegistration;
use App\Model\DiscoutStudent;
use App\Model\StudentClass;
use App\Model\StudentGroup;
use App\Model\StudentShit;
use App\Model\StudentYear;
use App\User;
use Storage;
use Image;
use DB;
use PDF;
class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $yeares= StudentYear::latest()->get();
      $classes= StudentClass::all();
      $year_id = StudentYear::orderBy('id','desc')->first()->id;
      $class_id = StudentClass::orderBy('id','asc')->first()->id;
      $data = StudentRegistration::where('year_id',$year_id)->where('class_id',$class_id)->get();
      return view('backend.Students.registration.index',compact('data','classes','yeares','year_id','class_id'));
    }

/**
*search data
*/
public function search(Request $request)
{
  $yeares= StudentYear::latest()->get();
  $classes= StudentClass::all();
  $year_id = $request->year_id;
  $class_id = $request->class_id;
  $data = StudentRegistration::where('year_id',$year_id)->where('class_id',$class_id)->get();
  return view('backend.Students.registration.index',compact('data','classes','yeares','year_id','class_id'));
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data['classes']= StudentClass::all();
      $data['groupes']= StudentGroup::all();
      $data['shiftes']= StudentShit::all();
      $data['yeares']= StudentYear::all();
      return view('backend.Students.registration.create',$data);
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
          'name'=>'required',
          'mobile'=>'required',
          'address'=>'required',
          'gender'=>'required',
          'image'=>'required',
          'fname'=>'required',
          'mname'=>'required',
          'religion'=>'required',
          'dob'=>'required',
          'class_id'=>'required',
          'year_id'=>'required',
          'discount'=>'required',

        ],[

        ]);

        DB::transaction(function()use($request){
            $checkYear = StudentYear::find($request->year_id)->year_name;
            $student = User::where('usertype','student')->orderBy('id','DESC')->first();
            if($student==null){
              $firstReg = 0;
              $studentId = $firstReg+1;
              if($studentId<10){
                $id_no = '000'.$studentId;
              }elseif ($studentId<100) {
                $id_no = '00'.$studentId;
              }elseif ($studentId<1000) {
                $id_no = '0'.$studentId;
              }
            }else {
              $student = User::where('usertype','student')->orderBy('id','DESC')->first()->id;
              $studentId=$student+1;
              if($studentId<10){
                $id_no='000'.$studentId;
              }elseif ($studentId<100) {
                $id_no = '00'.$studentId;
              }elseif ($studentId<1000) {
                $id_no = '0'.$studentId;
              }
            }
            $final_id = $checkYear.$id_no;//student id number
//student image
            if($request->hasFile('image')){
                  $image=$request->file('image');
                  $imageName='student_image-'.uniqid().'-'.time().'.'.$image->getClientOriginalExtension();
                  if(!Storage::disk('public')->exists('students')){
                      Storage::disk('public')->makeDirectory('students');
                  }
                  Image::make($image)->resize(150,150)->save(public_path('storage/students/'.$imageName));
                }else{
                  $imageName="default.png";
                }
//password auto generate
                $code = rand(0000,9999);

            $user = new User();
            $user->id_no=$final_id;
            $user->name=$request->name;
            $user->fname=$request->fname;
            $user->mname=$request->mname;
            $user->usertype='student';
            $user->email='student@gmail.com';
            $user->password=bcrypt($code);
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->gender=$request->gender;
            $user->image=$imageName;
            $user->religion=$request->religion;
            $user->dob= date('Y-m-d',strtotime($request->dob));
            $user->code=$code;
            $user->role_id='4';
            $user->save();

            $register_stu = new StudentRegistration();

            $register_stu->student_id=$user->id;
            $register_stu->class_id=$request->class_id;
            $register_stu->year_id=$request->year_id;
            $register_stu->group_id=$request->group_id;
            $register_stu->shift_id=$request->shift_id;
            $register_stu->save();

            $discount_stu=new DiscoutStudent();
            $discount_stu->registration_student_id = $register_stu->id;
            $discount_stu->fee_category_id = '1';
            $discount_stu->discount = $request->discount;
            $discount_stu->save();

        });
        Toastr::info('Success', 'Data Store Successfuly Done');
        return redirect()->route('registration-student.index')->with('Success','Data store Successfuly Done');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($student_id)
    {
//pdf generate
      $data['details']=StudentRegistration::with(['user','discount_stu'])->where('student_id',$student_id)->first();
	     $pdf = PDF::loadView('backend.Students.registration.student-details-pdf', $data);
       $pdf->SetProtection(['copy', 'print'], '', 'pass');
	      return $pdf->stream('document.pdf');

      // return view('backend.Students.registration.student-details-pdf',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($student_id)
    {
      $data['editData']= StudentRegistration::with(['user','discount_stu'])->where('student_id',$student_id)->first();
      // dd($data['editData']->toArray());
      $data['classes']= StudentClass::all();
      $data['groupes']= StudentGroup::all();
      $data['shiftes']= StudentShit::all();
      $data['yeares']= StudentYear::all();
      return view('backend.Students.registration.create',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $student_id)
    {
        // print_r($_POST);
        $this->validate($request,[
          'name'=>'required',
          'mobile'=>'required',
          'address'=>'required',
          'gender'=>'required',
          'image'=>'required',
          'fname'=>'required',
          'mname'=>'required',
          'religion'=>'required',
          'dob'=>'required',
          'class_id'=>'required',
          'year_id'=>'required',
          'discount'=>'required',

        ],[

        ]);

        DB::transaction(function()use($request,$student_id){

          $user =User::where('id',$student_id)->first();
        //student image
        $image=$request->file('image');
        if(isset($image)){

          $imageName='students_image_update'.uniqid().'-'.time().'.'.$image->getClientOriginalExtension();

          if(!Storage::disk('public')->exists('students')){
            Storage::disk('public')->makeDirectory('students');
          }
          if(Storage::disk('public')->exists('students/'.$user->image)){
            Storage::disk('public')->delete('students/'.$user->image);
          }
          Image::make($image)->resize(150,160)->save(public_path('storage/students/'.$imageName));
        }else{
          $imageName=$user->image;
        }

            $user->name=$request->name;
            $user->fname=$request->fname;
            $user->mname=$request->mname;
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->gender=$request->gender;
            $user->image=$imageName;
            $user->religion=$request->religion;
            $user->dob= date('Y-m-d',strtotime($request->dob));
            $user->save();

            $register_stu = StudentRegistration::where('id',$request->id)->where('student_id',$student_id)->first();
            $register_stu->class_id=$request->class_id;
            $register_stu->year_id=$request->year_id;
            $register_stu->group_id=$request->group_id;
            $register_stu->shift_id=$request->shift_id;
            $register_stu->save();

            $discount_stu=DiscoutStudent::where('registration_student_id',$request->id)->first();
            $discount_stu->discount = $request->discount;
            $discount_stu->save();

        });
        Toastr::info('Success', 'Data Update Successfuly Done');
        return back()->with('Success','Data Update Successfuly Done');
    }

    /**
     *student class promotion
     * Remove the specified resource from storage.
     *
     */

     public function promotion($student_id)
     {
       $data['editData']= StudentRegistration::with(['user','discount_stu'])->where('student_id',$student_id)->first();
       // dd($data['editData']->toArray());
       $data['classes']= StudentClass::all();
       $data['groupes']= StudentGroup::all();
       $data['shiftes']= StudentShit::all();
       $data['yeares']= StudentYear::all();
       return view('backend.Students.registration.promotion',$data);
     }


     public function promotionStore(Request $request, $student_id)
     {
         // print_r($_POST);
         $this->validate($request,[
           'class_id'=>'required',
           'year_id'=>'required',
           'discount'=>'required',

         ],[

         ]);

         DB::transaction(function()use($request,$student_id){

           $user =User::where('id',$student_id)->first();
         //student image
         $image=$request->file('image');
         if(isset($image)){

           $imageName='students_image_update'.uniqid().'-'.time().'.'.$image->getClientOriginalExtension();

           if(!Storage::disk('public')->exists('students')){
             Storage::disk('public')->makeDirectory('students');
           }
           if(Storage::disk('public')->exists('students/'.$user->image)){
             Storage::disk('public')->delete('students/'.$user->image);
           }
           Image::make($image)->resize(150,160)->save(public_path('storage/students/'.$imageName));
         }else{
           $imageName=$user->image;
         }

             $user->name=$request->name;
             $user->fname=$request->fname;
             $user->mname=$request->mname;
             $user->mobile=$request->mobile;
             $user->address=$request->address;
             $user->gender=$request->gender;
             $user->image=$imageName;
             $user->religion=$request->religion;
             $user->dob= date('Y-m-d',strtotime($request->dob));
             $user->save();

             $register_stu =new StudentRegistration();
             $register_stu->student_id=$student_id;
             $register_stu->class_id=$request->class_id;
             $register_stu->year_id=$request->year_id;
             $register_stu->group_id=$request->group_id;
             $register_stu->shift_id=$request->shift_id;
             $register_stu->save();

             $discount_stu= new DiscoutStudent();
             $discount_stu->registration_student_id = $register_stu->id;
             $discount_stu->fee_category_id = '2';
             $discount_stu->discount = $request->discount;
             $discount_stu->save();

         });
         Toastr::info('Success', 'Student Promotion Successfuly Done');
         return back()->with('Success','Student Promotion  Successfuly Done');
     }
    /**
     *student class promotion
     * Remove the specified resource from storage.
     *
     */



    public function destroy($student_id)
    {
        //
    }
}
