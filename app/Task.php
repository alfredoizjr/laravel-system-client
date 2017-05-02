<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Task extends Model
{
    //
  protected $table = 'tasks';
  protected $fillable = [  'id',
                           'task_type',
                           'task_body',
                           'status',
                           'created_at',
                           'updated_at',
                           'user_id',
                           'client_id'
                        ];

    public function client()
    {
      # code...
       return $this->belongsTo('App\Client');
    }

    public function user()
    {
      # code...
       return $this->belongsTo('App\User');
    }

    public function archives()
    {
        return $this->hasMany('App\ArchiveTask');
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

    //function for controller only the admin or user owner can modificate
          public function isOwnerUser()
          {
            # code...
            $user = new User;
            if(Auth::user()->id == $this->user_id or Auth::user()->roles ==='admin'){

              return true;
            }else{
              return false;
            }
          }


               public function getHr($to,$from){

                $to_time = strtotime($to);
                $from_time = strtotime($from);
                $hr = round(abs($to_time - $from_time) /(60*60),2);
                $hr = (60/100) * $hr;
                $hr = round(abs($hr),2);
                return $hr;
               }

}
