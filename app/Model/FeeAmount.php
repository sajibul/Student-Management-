<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FeeAmount extends Model
{
  protected $fillable = [
      'fee_categorie_id','class_id','amount',
  ];

  public function feeCategory()
      {
     return $this->belongsTo(FeeCategory::class,'fee_categorie_id','id');
     }
  public function student_class()
      {
     return $this->belongsTo(StudentClass::class,'class_id','id');
     }
}
