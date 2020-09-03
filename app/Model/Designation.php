<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
  protected $fillable = [
      'name',
  ];


  public function users()
      {
     return $this->hasMany('App\User','designation_id','id');
     }
}
