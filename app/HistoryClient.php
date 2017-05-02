<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryClient extends Model
{
    //
    protected $fillable = ['accion','client_id','user','description','avatar'];

    public function client()
       {
           return $this->belongsTo('App\Client');
       }
}
