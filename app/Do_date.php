<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Do_date extends Model
{
    //
   protected $fillable = ['expire','note','client_id'];

    public function client()
     {
         return $this->belongsTo('App\Client');
     }
}
