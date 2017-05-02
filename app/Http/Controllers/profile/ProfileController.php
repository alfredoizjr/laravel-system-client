<?php

namespace App\Http\Controllers\profile;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Task;
use Auth;
use Image;

class ProfileController extends Controller
{
  public function __construct()
  {

      $this->middleware('auth');

  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task ,User $user ,Request $request)
    {
        //
      $user = $user::find(Auth::user()->id);
      $task_close = $task->where('status','=','close')->where('user_id',$request->user()->id)->get();
      $task_open = $task->where('status','=','open')->where('user_id',$request->user()->id)->get();
        return view('profile.index',[
                                    'tasks_close'=>$task_close->count(),
                                    'task_open'=>$task_open->count(),
                                    'user'=>$user
                                  ]);
    }


    /**
     * Show the form for creating a new resource.
     *avatar resource form
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
           return view('user-manager.avatar_form');
    }

    public function updateAvatar(Request $request)
    {
        // the user upload avatar
        if($request->hasFile('avatar')){
           if(Auth::user()->avatar != 'profile.png'){
             $avatar = $request->file('avatar');
             $filename = Auth::user()->avatar;
             Image::make($avatar)->resize(300,300)->save('files/avatars/'.$filename);
             $user = Auth::user();
             $user->avatar = $filename;
             $user->save();
             notify()->flash('The images was upload', 'success');
             return redirect('profile');
           }else{
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save('files/avatars/'.$filename);
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
            notify()->flash('The images was upload', 'success');
            return redirect('profile');
          }
        }else{

          return back()->withInput();

        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::find($id);
        $open = $user->tasks->where('status','open')->count();
        $close = $user->tasks->where('status','close')->count();

        return view('profile.profile_for_manager',[
                                                  'data'=>$user,
                                                  'open'=>$open,
                                                  'close'=>$close
                                                ]);
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
        $user = new User;

        if($user->isOwnerUserOrAdmin($id)){
          $user = $user::find($id);
          return view('profile.edit',['data'=>$user]);
        }else{

          return redirect('profile')->with('warning','Do not can edit this user!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //

        if($user->isOwnerUserOrAdmin($request->id)){
        $user::find($request->id)->update($request->all());
        notify()->flash('the data Was edit!', 'success');
        return redirect('profile');
      }else{
          return redirect('profile')->with('warning','Do not can edit this user!');
      }
    }


/*---------change password form-------------*/

public function changePasswordForm(){

    return view('profile.change_password');


}

public function changePassword(User $user ,Request $request){

  $this->validate($request, [
      'password'=> 'required|min:6|confirmed'
  ]);

$user::where('id','=',$request->user()->id)->update(['password'=>bcrypt($request->password)]);
return redirect('profile')->with('info','The password has bein change');




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
    }
}
