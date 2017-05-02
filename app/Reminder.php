<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    //
    protected $table = 'reminders';
    protected $fillable = [
                            'title',
                            'body',
                            'expire',
                            'user_id'
                          ];

public function User()
{
    # code...
    return $this->belongsTo('App\User');
}


}
