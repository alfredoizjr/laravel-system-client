<?php

namespace App\Http\Controllers\clients;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Client;
use App\Service;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ServiceClientRequest;
use App\Task;
use App\Do_date;
use Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ClientsController extends Controller
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

    public function index(Client $client,Request $request)
    {
        //if si admin full show is no only by id

        $data = $client::where('status','=','p')->get();
        return view('clients.index',['data'=>$data]);

    }

    //show actives clients
    public function actives(Client $client,Request $request)
    {
        //if si admin full show is no only by id

        $data = $client::where('status','=','a')->get();
        return view('clients.actives',['data'=>$data]);

    }

    //show actives deactivated
    public function deactivated(Client $client,Request $request)
    {
        //if si admin full show is no only by id


        $data = $client::where('status','=','d')->get();
        return view('clients.deactivated',['data'=>$data]);

    }

    //show actives deactivated
    public function witDoDate(Client $client,Request $request)
    {
        //if si admin full show is no only by id


        $data = $client->do_date()->where('expire',date('Y-m-d'));
        return view('clients.pass_do_date',['data'=>$data]);

    }

    // change the status deactive
    public function status_d(Request $request,$id)
    {
        //if user is admin can deactivated the clients
        if($request->user()->roles ==='admin'){
        $client = new Client;
        $client::find($id)->update(['status'=>'d']);
        notify()->flash('Client is deactivated now!', 'warning');
        return redirect('deactivated');
      }else{
        notify()->flash('Sorry you dont have permission Administrator!', 'error');
        return redirect('clients');
      }
    }

    // change the status pending
    public function status_p($id)
    {
        //
        $client = new Client;
        $client::find($id)->update(['status'=>'p']);
         notify()->flash('Client is pending now!', 'warning');
          return redirect('clients');
    }

    // change the status deactive
    public function status_a($id)
    {
        //
        $client = new Client;
        $client::find($id)->update(['status'=>'a']);
         notify()->flash('Client is active now!', 'success');
          return redirect('actives');
    }

    // show all detail of clients like a folder
    // show tasks
    public function folder(Request $request,User $user,Client $client , Service $service, Task $task, $id)
    {
        //
        $client = $client::find($id);
        $extra = $client::find($id);
        $service = $service::all();
        $task = Task::select('tasks.id','tasks.task_type','tasks.task_body','users.name','tasks.created_at','users.avatar')
                           ->join('users','tasks.user_id','=','users.id')
                           ->where('tasks.user_id',$request->user()->id)
                           ->where('tasks.client_id',$id)->orderBy('created_at','desc')->get();


      return view('clients.folder',[
                       'data'=>$client,
                       'service'=>$service,
                       'task'=>$task,
                       'extra'=>$extra

                     ]);

    }

/*------------------------*/
/*services gestion insert*/
/*------------------------*/
public function insertService(Request $request, Client $client ,$id)
{
    //
    if($client->isOwnerUser() ){

    $client::find($id)->services()->attach($request->service);
    return redirect()->route('folder', ['id' => $id]);

  }else{

    return redirect()->route('folder', ['id' => $id])->with('warning', 'You dont can add services to this client!');
  }
}



/*------------------------*/
/*services gestion delete/*
/*------------------------*/
public function deleteService(Request $request,Client $client,$id)
{
    //
  if($client->isOwnerUser() ){
    $client::find($id)->services()->detach($request->service);

    return redirect()->route('folder', ['id' => $id]);
  }else{

    return redirect()->route('folder', ['id' => $id])->with('warning', 'You dont can add services to this client!');
  }
}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $client = new Client;
        return view('clients.insert',['data'=>$client]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request ,Client $client)
    {
      //validations
     //porccess for insert
   $client = new Client;


   if($request->hasFile('avatar')){
     $avatar = $request->file('avatar');
     $filename = time() . '.' . $avatar->getClientOriginalExtension();
     Image::make($avatar)->resize(300, 300)->save( 'files/avatars/' . $filename);
}else{
  $filename = "profile.png";
}



     $client->business_name = $request->business_name;
     $client->business_phone = $request->business_phone;
     $client->business_email = $request->business_email;
     $client->business_account = $request->business_account;
     $client->name = $request->name;
     $client->Last = $request->Last;
     $client->status = $request->status;
     $client->user_id = $request->user_id;
     $client->business_address = $request->business_address;
     $client->business_zip = $request->business_zip;
     $client->state = $request->state;
     $client->avatar = $filename;
     $client->save();
     notify()->flash('Client Was Inserted!', 'success');
     return redirect('clients');



   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Client $client)
    {
        //edit the element
        if($request->user()->roles === 'admin' or $request->user()->id === $client->user_id){
         return view('clients.edit',['data'=>$client]);
       }else{
         return redirect()->route('clients.index')->with('warning', 'dont try edit this clients!');
       }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //if this user is admin or this cient is belong to hem can edit

        if($request->user()->roles === 'admin' or $request->user()->id === $client->user_id){
          notify()->flash('the client was edited!', 'success');
          $client->update($request->all());
        return redirect()->route('clients.show', $client);
      }else{
          notify()->flash('warning', 'dont try edit this clients!', 'error');
          return redirect()->route('clients.index');
      }
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
