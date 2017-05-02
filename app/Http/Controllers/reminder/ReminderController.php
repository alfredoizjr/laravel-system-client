<?php

namespace App\Http\Controllers\reminder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReminderRequest;
use App\User;
use App\Reminder;
use Auth;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Reminder::where('user_id',Auth::user()->id)->paginate(10);
        return view('reminder.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = new Reminder;
        return view('reminder.create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReminderRequest $request)
    {
        //
        $reminder = new Reminder;
        $reminder->title = $request->title;
        $reminder->body = $request->body;
        $reminder->user_id = $request->user_id;
        $reminder->expire =  date('Y-m-d',strtotime($request->expire));
        $reminder->save();
        notify()->flash('The new reminder was inserted!', 'success');
        return redirect('reminder');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Reminder::find($id);
        return view('reminder.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReminderRequest  $request, $id)
    {
        //
        $remider = Reminder::find($id);
        $remider->title = $request->title;
        $remider->user_id = $request->user_id;
        $remider->expire = date('Y-m-d',strtotime($request->expire));
        $remider->body = $request->body;
        $remider->save();
        notify()->flash('Your reminder has ben change!', 'success');
        return redirect('reminder');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $remider = Reminder::find($id);
        $remider->delete();
        notify()->flash('Your reminder was delete!', 'success');
        return back()->withInput();
    }
}
