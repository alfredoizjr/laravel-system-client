<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Auth;
use App\User;
class Client extends Model
{
    //

    protected $fillable =[

      'business_name',
      'business_phone',
      'business_email',
      'business_account',
      'name',
      'Last',
      'user_id',
      'status',
      'id',
      'business_address',
      'business_zip',
      'state',
      'avatar'

    ];


    public function services()
     {
         return $this->belongsToMany('App\Service')->withPivot('expire');
     }

     public function user()
      {
          return $this->belongsTo('App\User');
      }

      public function tasks()
      {
        # code...
          return $this->hasMany('App\Task');
      }

      public function do_date()
      {
        # code...
        return $this->hasOne('App\Do_date');
      }

      public function external_links()
  {
      return $this->hasOne('App\ExternalLink');
  }

      public function extra()
      {
        # code...
          return $this->hasOne('App\Extra');
      }

      public function bussine()
   {
       return $this->hasOne('App\BussinessDirectoryListing');
   }

   public function historys()
  {
      return $this->hasMany('App\HistoryClient');
  }

// function para hallar los servicios que el cliente no tiene
      public function hasService($service_id)
      {
         if($this->services)
         {
          $service = $this->services()->where('service_id',$service_id)->first();

        if($service)
        {
         return TRUE;
        }
        else
        {
         return FALSE;
        }
         }
         else
         {
        return FALSE;
         }
      }


//function for controller only the admin or user owner can modificate
      public function isOwnerUser()
      {
        # code...
        $user = new User;
        if($user->id === $this->id or Auth::user()->roles ==='admin'){

          return true;
        }else{
          return false;
        }
      }




}
