<?php

namespace App\Http\Controllers\Request;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\TheRequest;
use App\User;
use App\RequestArchive;
use App\Http\Requests\RequestForUserRequest;
use Storage;
use File;
use Auth;


class RequestController extends Controller
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
    public function index()
    {
        //
        $request = new TheRequest;
        $request_close = new TheRequest;
        $request = $request::where('status','open')->get();
        //$request_close = $request_close::where('status','close')->get();
        return view('request.index',['request'=>$request]);
    }

    public function closeRequest()
    {
        //

        $request_close = new TheRequest;
        $request_close = $request_close::where('status','close')->get();
        if($request_close ->count() > 0){
        return view('request.close_request',['close'=>$request_close]);
      }else{

        redirect('home');
      }
    }

    public function ActionReopenRequest($id)
    {

        $request_close = TheRequest::find($id);
        $request_close->status = "open";
        $request_close->save();
        notify()->flash('The request is Open now ','success');
        return redirect('request');
    }

    public function Actionclose($id)
    {
        //
        $request_close = TheRequest::find($id);
        $request_close->status = "close";
        $request_close->save();
        notify()->flash('The request is close ','success');
        return redirect('request-close');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $therequest = new TheRequest;
        $user = User::get();
        return view('request.create',['request'=>$therequest,'user'=>$user]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestForUserRequest $request)
    {
        //

        $request_data = new TheRequest;
         $request_data->title = $request->title;
         $request_data->user_id = $request->user_id;
         $request_data->owner = $request->owner;
         $request_data->body = $request->body;
         $request_data->do_date = date('Y-m-d',strtotime($request->do_date));
         $request_data->save();
         $last = $request_data::get()->last()->id;

        if($request->hasFile('archive')){
          $temp = $request->file('archive');
          $original =$request->file('archive')->getClientOriginalName();
          $ext = $request->file('archive')->getClientOriginalExtension();
          $name = $last."_".$original;
          Storage::disk('request')->put($name,File::get($temp));
          $archive = new RequestArchive;
          $archive->name_archive =  $name;
          $archive->ext_archive  =  $ext;
          $archive->original     =  $original;
          $archive->the_request_id   =  $last;
          $archive->save();
        }

        notify()->flash('The request was submit ','success');
        return redirect('request')->with('success', 'The request was create!');

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
        $data = new TheRequest;
        $data = $data::find($id);
        $user = User::find($data->user_id);
        return view('request.show',['data'=>$data,'user'=>$user]);

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
        $request = TheRequest::find($id);
        return view('request.edit',['request'=>$request]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

         $request_data = TheRequest::find($id);
         $request_data->title = $request->title;
         $request_data->user_id = $request->user_id;
         $request_data->owner = $request->owner;
         $request_data->body = $request->body;
         $request_data->do_date = date('Y-m-d',strtotime($request->do_date));
         $request_data->save();

         if($request->hasFile('archive')){

           $temp = $request->file('archive');
           $original =$request->file('archive')->getClientOriginalName();
           $ext = $request->file('archive')->getClientOriginalExtension();
           $name = $id."_".$original;
           $archive = RequestArchive::where('the_request_id',$id)->where('name_archive',$name)->first();

           if($archive){
               Storage::disk('request')->put($name,File::get($temp));
               notify()->flash('Request edited the archive was changes ! ','success');
               return back()->withInput();

            }else{
          $archive = new RequestArchive;
           $archive->name_archive =  $name;
           $archive->ext_archive  =  $ext;
           $archive->original     =  $original;
           $archive->the_request_id   =  $id;
           $archive->save();
           Storage::disk('request')->put($name,File::get($temp));
           notify()->flash('The request was edited and the new archive add! ','success');
          return back()->withInput();
          }
         }

        // notify()->flash('The request was edited! ','success');
      //  return back()->withInput();
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
