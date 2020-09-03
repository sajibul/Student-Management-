<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Model\AssignSubject;
use App\Model\Subject;
use App\Model\StudentClass;
use Auth;
class AssignSubjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = AssignSubject::select('class_id')->groupBy('class_id')->get();
      return view('backend.setup.SubjectAssign.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $allclass=StudentClass::all();
      $allsubject=Subject::all();
      return view('backend.setup.SubjectAssign.create',compact('allclass','allsubject'));
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
        'class_id'=>'required',
        'subject_id'=>'required',
        'full_mark'=>'required',
        'pass_mark'=>'required',
        'subjective_mark'=>'required',
      ],[

      ]);
      $subjectinfo = count($request->subject_id);
      if($subjectinfo!=NULL){
        for ($i=0; $i < $subjectinfo; $i++) {
          $data = new AssignSubject();
          $data->class_id=$request->class_id;
          $data->subject_id=$request->subject_id[$i];
          $data->full_mark=$request->full_mark[$i];
          $data->pass_mark=$request->pass_mark[$i];
          $data->subjective_mark=$request->subjective_mark[$i];
          $data->save();
        }
      }
      Toastr::success('Success', 'Data Store success');
      return redirect()->route('assign-subject.index')->with('success','Data store successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($class_id)
    {
        $details=AssignSubject::where('class_id',$class_id)->get();
          return view('backend.setup.SubjectAssign.view',compact('details'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($class_id)
    {
      $editData = AssignSubject::where('class_id',$class_id)->orderBy('subject_id','asc')->get();
      $allclass=StudentClass::all();
      $allsubject=Subject::all();
      return view('backend.setup.SubjectAssign.edit',compact('allclass','allsubject','editData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $class_id)
    {
      $this->validate($request,[
        'class_id'=>'required',
        'subject_id'=>'required',
        'full_mark'=>'required',
        'pass_mark'=>'required',
        'subjective_mark'=>'required',
      ],[

      ]);

      if($request->subject_id==NULL){
        Toastr::warning('warning', 'Sorry! you not fill class item!');
        return back()->with('error','You must have fill class item');
      }else{
         AssignSubject::whereNotIn('subject_id',$request->subject_id)->where('class_id',$class_id)->delete();

         foreach ($request->subject_id as $key => $value) {
           $assign_subject_exit = AssignSubject::where('subject_id',$request->subject_id[$key])->where('class_id',$request->class_id)->first();
           if($assign_subject_exit){
             $assignSubject = $assign_subject_exit;
           }else {
             $assignSubject= new AssignSubject();
           }
           // $data = new AssignSubject();
           $assignSubject->class_id=$request->class_id;
           $assignSubject->subject_id=$request->subject_id[$key];
           $assignSubject->full_mark=$request->full_mark[$key];
           $assignSubject->pass_mark=$request->pass_mark[$key];
           $assignSubject->subjective_mark=$request->subjective_mark[$key];
           $assignSubject->updated_by=Auth::user()->id;
           $assignSubject->save();
         }

          Toastr::success('Success', 'Data Update success');
          return redirect()->route('assign-subject.index')->with('success','Data Update successfuly');
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
