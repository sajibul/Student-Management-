<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
class StudentRegistration extends Model
{
  public function user()
      {
     return $this->belongsTo('App\User','student_id','id');
     }
  public function class()
      {
     return $this->belongsTo('App\Model\StudentClass','class_id','id');
     }
  public function year()
      {
     return $this->belongsTo('App\Model\StudentYear','year_id','id');
     }
  public function discount_stu()
      {
     return $this->belongsTo('App\Model\DiscoutStudent','id','registration_student_id');
     }
}
