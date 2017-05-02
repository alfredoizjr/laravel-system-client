<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{

   protected $fillable = [
                           'id',
                           'web_url',
                           'hosting_info',
                           'hosting_user',
                           'hosting_password',
                           'client_id',
                           'pin',
                           'Cpanel',
                           'Cpanel_password',
                           'email_one',
                           'email_two',
                           'email_password'
                        ];
    //
    public function clients()
    {
      # code...
       return $this->belongsTo('App\Client');
    }
}
