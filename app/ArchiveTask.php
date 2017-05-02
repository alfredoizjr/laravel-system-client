<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchiveTask extends Model
{
    protected $fillable = [
                            'name_archive',
                            'ext_archive',
                            'task_id',
                            'original',
                            'id'
                           ];



 public function task()
  {
    return $this->belongsTo('App\Task');
  }

}
