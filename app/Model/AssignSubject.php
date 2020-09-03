<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssignSubject extends Model
{
  protected $fillable = [
      'class_id','subject_id','full_mark','pass_mark','get_mark',
  ];

  public function student_class()
      {
     return $this->belongsTo(StudentClass::class,'class_id','id');
     }
  public function student_subject()
      {
     return $this->belongsTo(Subject::class,'subject_id','id');
     }
}
