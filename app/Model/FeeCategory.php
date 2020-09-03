<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FeeCategory extends Model
{
  protected $fillable = [
      'name',
  ];

  public function feeAmount()
      {
     return $this->hasMany('App\Model\FeeAmount','fee_categorie_id','id');
     }

}
