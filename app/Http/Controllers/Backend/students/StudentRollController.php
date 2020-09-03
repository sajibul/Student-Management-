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
class StudentRollController extends Controller
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
      return view('backend.Students.Roll.index',compact('classes','yeares'));
    }


    public function getStudent(Request $request)
    {
      $allData = StudentRegistration::with(['user'])->where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
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
      $year_id = $request->year_id;
      $class_id=$request->class_id;

      if($request->student_id !=null){
        for ($i=0; $i < count($request->student_id); $i++) {
          StudentRegistration::where('year_id',$year_id)->where('class_id',$class_id)->where('student_id',$request->student_id[$i])->update(['student_roll'=>$request->roll[$i]]);
        }
      }else {
        Toastr::warning('warning', 'Sorry! There are no student');
        return redirect()->back()->with('error','Sorry! There are no student');
      }
        Toastr::success('Success', 'Well done roll generate successfuly');
      return redirect()->route('student-roll-generate.index');
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
