<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserManagerRequest;
use App\User;
use App\Client;
use Auth;

class UserManagerController extends Controller
{

  public function __construct()
  {

      $this->middleware('auth');
      $this->middleware('Admin');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        //
        $user::all();
        return view('user-manager.index',['user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('user-manager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user ,UserManagerRequest $request)
    {
        //
        $user->name = $request->name;
        $user->email = $request->email;
        $user->roles = $request->roles;
        $user->password = bcrypt($request->password);
        $user->save();
        notify()->flash('the user was created correctly!!', 'success');
        return redirect('user');
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
        $user = new User;

        if($user->isOwnerUser()){
          $user = $user::find($id);
          return view('user-manager.edit',['data'=>$user]);
        }else{

          return redirect('user')->with('Do not can edit this user!');
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
        $user->update($request->all());
        return redirect('user')->with('success', 'User Was edit!');
    }

    /*-------------------------------------------------------*/
    /*------------permission method get admin ----------------*/
    /*-------------------------------------------------------*/

    public function GetpermissionAdmin($id)
    {
        //
        User::find($id)->update(['roles'=>'admin']);
        return redirect('user')->with('success', 'This user now is administrator!');
    }


    /*-------------------------------------------------------*/
    /*------------permission method remove admin ----------------*/
    /*-------------------------------------------------------*/
    public function RemovepermissionAdmin($id)
    {
        //
        User::find($id)->update(['roles'=>'worker']);
        return redirect('user')->with('success', 'This user now is worker!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //

        $user = User::find($id);

        if($user){

          $user->clients()->update(['user_id'=> 0]);
          $user->tasks()->delete();
          $user->the_requests()->delete();
          $user->delete();
        }
         notify()->flash('This user Was Deleted', 'success');
        return redirect('user');

    }
}
