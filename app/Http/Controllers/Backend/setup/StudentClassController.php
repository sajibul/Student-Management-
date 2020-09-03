<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Model\StudentClass;
use DB;
class StudentClassController extends Controller
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
      $data = StudentClass::latest()->get();
      return view('backend.setup.class.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.setup.class.create');
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
          'className'=>'required|unique:student_classes,name',
        ],[

        ]);

        $data = new StudentClass;
        $data->name=$request->className;
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
      $data = StudentClass::find($id);
      return view('backend.setup.class.edit',compact('data'));
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
      $data = StudentClass::find($id);
      $this->validate($request,[
        'className'=>'required|unique:student_classes,name',$data,
      ],[

      ]);

      $data->name=$request->className;
      $data->save();
        Toastr::success('Success', 'Data update success');
      return back()->with("success","Data Update Successfuly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = StudentClass::find($id)->delete([

        ]);
        Toastr::warning('Success', 'Data Delete Success');
        return back();
    }
}
