<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
  protected $fillable = [
      'employee_id','leave_purposes_id','start_date','end_date',
  ];

  public function leave_purposes()
      {
     return $this->belongsTo(LeavePurpose::class,'leave_purposes_id','id');
     }
     public function employee()
         {
        return $this->belongsTo('App\User','employee_id','id');
        }
}
