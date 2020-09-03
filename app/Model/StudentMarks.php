<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentMarks extends Model
{
  protected $fillable = [
      'student_id', 'student_roll', 'id_no','class_id','year_id','assign_subjects_id','exam_type_id','marks',
  ];


  public function user()
  {
 return $this->belongsTo('App\User','student_id','id');
 }

}
