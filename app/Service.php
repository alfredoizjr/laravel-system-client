<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Service extends Model
{
    //
    protected $fillable = ['service_name'];

    public function clients()
     {
         return $this->belongsToMany('App\Client')->withPivot('expire');
     }

     public function expires()
     {
       # code...
         return $this->hasMany('App\ExpireService');
     }





}
