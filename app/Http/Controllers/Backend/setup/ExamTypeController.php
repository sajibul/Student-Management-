<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use App\Model\ExamType;
class ExamTypeController extends Controller
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
      $data = ExamType::latest()->get();
      return view('backend.setup.ExamType.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('backend.setup.ExamType.create');
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
        'name'=>'required|unique:exam_types,name',
      ],[

      ]);
      $data   = new  ExamType();
      $data->name=$request->name;
      $data->save();
      Toastr::success('Success', 'Data Store success');
      return redirect()->route('exam-type.index');
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
      $editData = ExamType::find($id);
        return view('backend.setup.ExamType.create',compact('editData'));
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
        $data   =  ExamType::find($id);
      $this->validate($request,[
        'name'=>'required|unique:exam_types,name',$data,
      ],[

      ]);

      $data->name=$request->name;
      $data->save();
      Toastr::success('Success', 'Data update successfuly done');
      return redirect()->route('exam-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data =  ExamType::find($id)->delete();
        // dd($data->toArray());
        Toastr::warning('Success', 'Data delete successfuly done');
        return redirect()->route('exam-type.index');
    }
}
