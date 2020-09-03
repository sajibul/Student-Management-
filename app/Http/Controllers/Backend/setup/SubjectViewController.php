<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Model\Subject;
class SubjectViewController extends Controller
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
      $data = Subject::latest()->get();
      return view('backend.setup.SubjectView.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$data = Subject::latest()->get();
        return view('backend.setup.SubjectView.create');
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
        'name'=>'required|unique:subjects,name',
      ],[

      ]);
      $data = new Subject();
      $data->name=$request->name;
      $data->save();
      Toastr::success('Success', 'Data Store success');
      return redirect()->route('subject-view.index');

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
      $editData = Subject::find($id);
      return view('backend.setup.SubjectView.create',compact('editData'));
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
      $data =  Subject::find($id);
      $this->validate($request,[
        'name'=>'required|unique:subjects,name',$data,
      ],[

      ]);

      $data->name=$request->name;
      $data->save();
      Toastr::success('Success', 'Data update success');
      return redirect()->route('subject-view.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $data =  Subject::find($id)->delete();
      Toastr::success('Success', 'Data delete successfuly done');
      return redirect()->route('subject-view.index');
    }
}
