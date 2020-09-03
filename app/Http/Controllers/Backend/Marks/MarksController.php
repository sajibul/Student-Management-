<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Model\StudentClass;
use App\Model\StudentYear;
use App\Model\StudentMarks;
use App\Model\Subject;
use App\Model\AssignSubject;
use App\Model\StudentRegistration;
use App\Model\ExamType;
use App\User;
use Storage;
use Image;
use DB;
use PDF;
class MarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['classes']=StudentClass::all();
      $data['yeares']=StudentYear::all();
      $data['marksData']=StudentMarks::all();
      $data['examType']=ExamType::all();
      // $data['allstudent']=User::where('usertype','student')->orderBy('id_no','asc')->get();
      return view('backend.MarksManagement.marksCreate',$data);
    }

/**
  *subject assign by class wise
  *
*/

  public function getsubject(Request  $request)
  {
    $class_id = $request->class_id;
    $allData = AssignSubject::with('student_subject')->where('class_id',$class_id)->get();
    return response()->json($allData);
  }


  //add mark in marksheet

  public function getStudent(Request $request)
  {
    // dd('0k');
    $year_id=$request->year_id;
    $class_id=$request->class_id;
    $allData=StudentRegistration::with('user')->where('class_id',$class_id)->where('year_id',$year_id)->get();
    return response()->json($allData);
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

      $studentCount = $request->student_id;
      if($studentCount){
       
        for ($i=0; $i < count($request->student_id); $i++) {
          $data = new StudentMarks();
          $data->student_id=$request->student_id[$i];
          $data->student_roll=$request->student_roll[$i];
          $data->id_no=$request->id_no[$i];
          $data->class_id=$request->class_id;
          $data->year_id=$request->year_id;
          $data->assign_subjects_id=$request->assign_subjects_id;
          $data->exam_type_id=$request->exam_type_id;
          $data->marks=$request->marks[$i];
          $data->save();
        }
        
          Toastr::success('Success', 'Well done mark insert successfuly'); 
      
         return back();
      }else {
          Toastr::success('Success', 'There is no student');
      }


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
    public function marksEdit()
    {
      $data['classes']=StudentClass::all();
      $data['yeares']=StudentYear::all();
      $data['examType']=ExamType::all();
      // $data['allstudent']=User::where('usertype','student')->orderBy('id_no','asc')->get();
      return view('backend.MarksManagement.marksEdit',$data);
    }

    public function getMarks(Request $request){

          $class_id=$request->class_id;
          $year_id=$request->year_id;
          $assign_subjects_id=$request->assign_subjects_id;
          $exam_type_id=$request->exam_type_id;

          $editData = StudentMarks::with(['user'])->where('class_id',$class_id)->where('year_id',$year_id)->where('assign_subjects_id',$assign_subjects_id)->where('exam_type_id',$exam_type_id)->get();
          return response()->json($editData);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function markUpdate(Request $request)
    {

      $marks=100;
      
       StudentMarks::where('class_id',$request->class_id)->where('year_id',$request->year_id)->where('assign_subjects_id',$request->assign_subjects_id)->where('exam_type_id',$request->exam_type_id)->delete();
       $studentCount = $request->student_id;
       if($studentCount){
         for($i=0; $i< count($request->student_id);$i++){
         
          $data = new StudentMarks();
          $data->student_id=$request->student_id[$i];
          $data->student_roll=$request->student_roll[$i];
          $data->id_no=$request->id_no[$i];
          $data->class_id=$request->class_id;
          $data->year_id=$request->year_id;
          $data->assign_subjects_id=$request->assign_subjects_id;
          $data->exam_type_id=$request->exam_type_id;
          $data->marks=$request->marks[$i];
          $data->save();
         }
         Toastr::success('Success', 'Well done mark update successfuly');
         return back();
       }else{
        Toastr::error('Error', 'There is no student');
       }
      
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
