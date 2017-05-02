<?php

namespace App\Http\ViewComposers;
use Illuminate\Contracts\View\View;
use App\User;
use App\Task;
use Auth;
use Illuminate\Http\Request;

class RequestComposer
{

  public function compose(View $view)
  {

     $open_request =  User::find(Auth::user()->id)->the_requests()->where('status','=','open')->count();
     $view->with('open_request',$open_request);
  }

}
