<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BussinessDirectoryListing extends Model
{

    protected $fillable =['id','login_website','name_listing','email','password','sucribed','long','client_id','expire'];
    //
    public function client()
 {
     return $this->belongsTo('App\Client');
 }

}
