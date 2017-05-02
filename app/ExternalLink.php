<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExternalLink extends Model
{
    //
   protected $fillable = ['login_website','email','password','client_id'];

    public function client(){
      return $this->belongsTo('App\Client');
    }
}
