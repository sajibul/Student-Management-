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
use App\Model\FeeAmount;
use App\User;
use Storage;
use Image;
use DB;
use PDF;
class RegistrationFeeController extends Controller
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
      return view('backend.Students.RegistrationFee.index',compact('yeares','classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $year_id = $request->year_id;
      $class_id = $request->class_id;
      if($year_id !=''){
        $where[] = ['year_id','like',$year_id.'%'];
      }
      if($class_id !=''){
        $where[] = ['class_id','like',$class_id.'%'];
      }

      $allStudent = StudentRegistration::with(['discount_stu'])->where($where)->get();
      //dd($allStudent)
      $html['thsource'] = '<th>SL</th>';
      $html['thsource'] .='<th>ID NO</th>';
      $html['thsource'] .='<th>Student Name</th>';
      $html['thsource'] .='<th>Roll No</th>';
      $html['thsource'] .='<th>Registration Fee</th>';
      $html['thsource'] .='<th>Discount Amount</th>';
      $html['thsource'] .='<th>Fee (This student)</th>';
      $html['thsource'] .='<th>Action<th>';

      foreach($allStudent as $key =>$value){
        $registrationfee = FeeAmount::where('fee_categorie_id','1')->where('class_id',$value->class_id)->first();
        $color = 'success';
        $html[$key]['tdsource']  ='<td>'.($key+1).'</td>';
        $html[$key]['tdsource'] .='<td>'.$value['user']['id_no'].'</td>';
        $html[$key]['tdsource'] .='<td>'.$value['user']['name'].'</td>';
        $html[$key]['tdsource'] .='<td>'.$value->student_roll.'</td>';
        $html[$key]['tdsource'] .='<td>'.$registrationfee->amount.'TK'.'</td>';
        $html[$key]['tdsource'] .='<td>'.$value->discount_stu->discount.'%'.'</td>';

        $originalfee = $registrationfee->amount;
        $discount = $value->discount_stu->discount;
        $discountablefee = $discount/100*$originalfee;
        $finalfee = (float)$originalfee-(float)$discountablefee;

        $html[$key]['tdsource'] .= '<td>'.$finalfee.'TK'.'</td>';
        $html[$key]['tdsource'] .= '<td>';
        $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="Payslip" target="_black" href="'.route("student.registration.fee.Payslip").'?class_id='.$value->class_id.'&student_id='.$value->student_id.'">Fee Slip </a>';
        $html[$key]['tdsource'] .='</td>';

      }
        return response()->json(@$html);
}


      public function Payslip(Request $request)
      {
          $student_id=$request->student_id;
          $class_id=$request->class_id;

          $allstudent['details']=StudentRegistration::with(['discount_stu','user'])->where('student_id',$student_id)->where('class_id',$class_id)->first();
          $pdf = PDF::loadView('backend.Students.RegistrationFee.payment-details-pdf',$allstudent);
          $pdf->SetProtection(['copy', 'print'], '', 'pass');
          return $pdf->stream('payslip.pdf');
      }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
