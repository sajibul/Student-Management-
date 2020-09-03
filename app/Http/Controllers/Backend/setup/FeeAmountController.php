<?php

namespace App\Http\Controllers\Backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use App\Model\FeeCategory;
use App\Model\StudentClass;
use App\Model\FeeAmount;
use DB;
class FeeAmountController extends Controller
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
      $data = FeeAmount::select('fee_categorie_id')->groupBy('fee_categorie_id')->get();
      // $data = FeeAmount::all();
      return view('backend.setup.FeeAmount.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $allfeecategory = FeeCategory::all();
      $allclass = StudentClass::all();
      return view('backend.setup.FeeAmount.create',compact('allfeecategory','allclass'));
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
          'fee_categorie_id'=>'required',
          'class_id'=>'required',
          'amount'=>'required',
        ],[

        ]);
        $countClass = count($request->class_id);
        if($countClass!=NULL){
          for($i=0; $i<$countClass;$i++){
            $fee_amount = new FeeAmount();
            $fee_amount->fee_categorie_id=$request->fee_categorie_id;
            $fee_amount->class_id=$request->class_id[$i];
            $fee_amount->amount=$request->amount[$i];
            $fee_amount->save();
          }
        }
           Toastr::success('Success', 'Data Store success');
           return back()->with('success','Data store successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($fee_categorie_id)
    {
      $details = FeeAmount::where('fee_categorie_id',$fee_categorie_id)->get();
        // dd($details->toArray());
        return view('backend.setup.FeeAmount.view',compact('details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($fee_categorie_id)
    {
      $editData = FeeAmount::where('fee_categorie_id',$fee_categorie_id)->orderBy('class_id','asc')->get();
      // dd($editData->toArray());
      $allfeecategory = FeeCategory::all();
      $allclass = StudentClass::all();
      return view('backend.setup.FeeAmount.edit',compact('editData','allfeecategory','allclass'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fee_categorie_id)
    {
      $this->validate($request,[
        'fee_categorie_id'=>'required',
        'class_id'=>'required',
        'amount'=>'required',
      ],[

      ]);
      if($request->class_id==NULL){
        Toastr::warning('warning', 'You do not selected any item of class');
        return redirect()->back()->with('error','Sorry! You do not selected any ');
      }else {
        FeeAmount::where('fee_categorie_id',$fee_categorie_id)->delete();
        $countClass = count($request->class_id);
        if($countClass!=NULL){
          for($i=0; $i<$countClass;$i++){
            $fee_amount = new FeeAmount();
            $fee_amount->fee_categorie_id=$request->fee_categorie_id;
            $fee_amount->class_id=$request->class_id[$i];
            $fee_amount->amount=$request->amount[$i];
            $fee_amount->save();
      }
    }
    Toastr::Success('Success', 'Data store successfuly done');
    return back();
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
