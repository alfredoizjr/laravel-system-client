<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TheRequest extends Model
{
    //

    protected $fillable = ['body','owner','title','do_date','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function archives()
    {
        return $this->hasMany('App\RequestArchive');
    }


    // method for curt the string in task
      public function curtString($value){

          $data = substr($value, 0,40);

         if(strlen($value) > 40) {
           return $data ." (...)";
         } else{
           return $data ."";
         }
      }


}
