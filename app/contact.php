<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    //
    protected $fillable = ['id','user_id','name','email'];


    public function user(){
      $this->belongsTo('App\User');
    }
}
