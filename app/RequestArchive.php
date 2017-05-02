<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestArchive extends Model
{
    //
    protected $fillable = [
                            'name_archive',
                            'ext_archive',
                            'the_request_id',
                            'original',
                            'id'
                           ];

public function request()
{
    return $this->belongsTo('App\TheRequest');
  }
}
