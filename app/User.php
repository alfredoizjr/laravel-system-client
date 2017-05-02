<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','roles',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function clients()
     {
         return $this->hasMany('App\Client');
     }

     public function reminders()
      {
          return $this->hasMany('App\Reminder');
      }

     public function tasks()
     {
       # code...
         return $this->hasMany('App\Task');
     }

     public function the_requests()
      {
          return $this->hasMany('App\TheRequest');
      }
      public function contacts()
       {
           return $this->hasMany('App\contact');
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

           public function isOwnerUserOrAdmin($value)
           {
             # code...
             $user = new User;
             if(Auth::user()->id == $value or Auth::user()->roles ==='admin'){

               return true;
             }else{
               return false;
             }
           }

           public function scopeSearch($query , $name){
               return $query->where('name','LIKE',"%$name%");
           }

}
