<?php

namespace App\Http\Controllers\task;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use App\User;
use App\Service;
use App\Task;
use App\Http\Requests\TaskRequest;
use App\ArchiveTask;
use Auth;
use Storage;
use File;


class TaskController extends Controller
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
    public function index(Task $task,Request $request)
    {
        //

         $task = $task->where('status','=','open')->where('user_id',$request->user()->id)->orderBy('id','desc')->get();

        return view('task.index',['task'=>$task]);
    }

      // show close task

      public function showCloseTask(Task $task,Request $request)
      {
          //

           $task = $task->where('status','=','close')->where('user_id',$request->user()->id)->orderBy('id','desc')->get();

          return view('task.close_task',['task'=>$task]);
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Client $client,Service $service)
    {
        //
        if($client->count()>0){
        $task = new Task;

        return view('task.create',[
                                   'service' => $service,
                                   'task'=>$task ,
                                   'client'=>$client
                                 ]);
        }else{

          notify()->flash('error no found any client for insert any task!', 'error');
          return back()->withInput();
        }
    }
// if coming form the folder of client
    public function create_in_client(Service $service,$id)
    {
        //
        $task = new Task;
        return view('task.create_in_client',['data'=>$id,'service'=> $service,'task'=>$task]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request,Task $task)
    {
        //
      if(isset($request->create)){
          $task::create($request->all());
          $task = $task::get();
         //archives
        if($request->hasFile('archive')){
          $temp = $request->file('archive');
          $original =$request->file('archive')->getClientOriginalName();
          $ext = $request->file('archive')->getClientOriginalExtension();
          $name = $task->last()->id."_".$original;
          Storage::disk('archives')->put($name,File::get($temp));
          $archive = new ArchiveTask;
          $archive->name_archive =  $name;
          $archive->ext_archive  =  $ext;
          $archive->original     =  $original;
          $archive->task_id      =  $task->last()->id;
          $archive->save();
        }
        //archives
          notify()->flash('Task was inserted', 'success');
          return redirect('task');
       }else{
          $task::create($request->all());
          $task = $task::get();
         //archives
          if($request->hasFile('archive')){
            $temp = $request->file('archive');
            $original =$request->file('archive')->getClientOriginalName();
            $ext = $request->file('archive')->getClientOriginalExtension();
            $name = $task->last()->id."_".$original;
            Storage::disk('archives')->put($name,File::get($temp));
            $archive = new ArchiveTask;
            $archive->name_archive =  $name;
            $archive->ext_archive  =  $ext;
            $archive->original     =  $original;
            $archive->task_id      =  $task->last()->id;
            $archive->save();
          }
           notify()->flash('Task was inserted on thi user', 'success');
         return redirect()->route('folder',[$request->client_id]);
       }
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
          $task = new Task;
          $data = $task::find($id);
          return view('task.show',['data'=>$data]);
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
        $task = new Task;
        $task = $task::find($id);
        if($task->status === 'close')
        {
          return back()->withInput();
        }else{
        $client = $task->client->id;
        return view('task.edit',['task'=>$task,'client'=>$client]);
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        //
      if($task->isOwnerUser()){
        $task->update($request->all());
        //archives
       if($request->hasFile('archive')){
         $temp = $request->file('archive');
         $original =$request->file('archive')->getClientOriginalName();
         $ext = $request->file('archive')->getClientOriginalExtension();
         $name = $request->id."_".$original;
         $archive = ArchiveTask::where('task_id',$request->id)->where('name_archive',$name);
         if($archive->count() > 0){
           Storage::disk('archives')->put($name,File::get($temp));
           notify()->flash('Only the archive was remplace! ','success');
           return back()->withInput();
         }else{
         Storage::disk('archives')->put($name,File::get($temp));
         $archive = new ArchiveTask;
         $archive->name_archive =  $name;
         $archive->ext_archive  =  $ext;
         $archive->original     =  $original;
         $archive->task_id      =  $request->id;
         $archive->save();
         notify()->flash('The task was edited!', 'success');
         return back()->withInput();
        }
      }else{
        notify()->flash('The task was edited!', 'success');
        return back()->withInput();

      }
       //archives
     }else{
      notify()->flash('This task does not belong to you!', 'error');
      return redirect('task');
      }
    }

    // close the task for the worker or admin

    public function closeTask($id)
    {
        //
        $task = Task::find($id);
        if($task->isOwnerUser()){
        $task->update(['status'=>'close']);
        return redirect()->route('task.show',$task->id)->with('success','The task is close');

      }else{
          return redirect()->route('task.show',$task->id)->with('warning','This task does not belong to you!');
       }

    }


    public function delete($id)
    {
        //

        $task =Task::find($id);
        foreach ($task->archives as $archive) {
          File::delete('files/archives/'.$archive->name_archive);
        }
        $task->archives()->delete();
        $task->delete();

        notify()->flash('The task was deleted', 'success');
         return redirect('task');
       }


}
