<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Task;
use App\Do_date;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user ,Client $client, Task $task,Request $request)
    {
        $request_user = $user::find($request->user()->id)->the_requests()->where('status','=','open');
        $user = $user::find($request->user()->id)->clients();
        $task = Task::where('user_id',$request->user()->id);
        $client = Do_date::where('expire','=',date('Y-m-d'))->get();

        return view('home',[
                            'clients_i_have'=>$user->count(),
                            'task_i_have'=>$task->count(),
                            'do_date' => $client,
                            'the_request'=> $request_user->count()
                          ]);
    }
}
