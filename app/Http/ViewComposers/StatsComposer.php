<?php

namespace App\Http\ViewComposers;
use Illuminate\Contracts\View\View;
use App\User;
use App\Task;
use Auth;
use Illuminate\Http\Request;

class StatsComposer
{

  public function compose(View $view)
  {

     $open_task =  Task::where('status','=','open')->where('user_id',Auth::user()->id)->count();
     $view->with('open_task',$open_task);
  }

}
