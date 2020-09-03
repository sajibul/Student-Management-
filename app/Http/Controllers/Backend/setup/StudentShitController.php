<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\StudentShit;
use Brian2694\Toastr\Facades\Toastr;
use DB;
class StudentShitController extends Controller
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
      $data = StudentShit::latest()->get();
      return view('backend.setup.shiftes.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.setup.shiftes.create');
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
        'name'=>'required|unique:student_shits,name',
      ],[

      ]);
        $data  = new  StudentShit();
        $data->name=$request->name;
        $data->save();
        Toastr::success('Success', 'Data Store success');
        return back()->with("success","Data store successfuly");
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
      $editData  = StudentShit::find($id);
      return view('backend.setup.shiftes.create',compact('editData'));
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
      $data = StudentShit::find($id);
      $this->validate($request,[
        'name'=>'required|unique:student_shits,name',$data,
      ],[

      ]);
      $data->name=$request->name;
      $data->save();
      Toastr::success('Success', 'Data Update success');
      return back()->with("success","Data Update successfuly");
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
