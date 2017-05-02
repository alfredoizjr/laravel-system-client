<?php

namespace App\Http\Controllers\services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Client;
use App\Service;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ServiceClientRequest;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{

  public function __construct(){
    
       $this->middleware('auth');
       $this->middleware('Admin');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Service $service)
    {
        //

        return view('services.index',['service'=>$service]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request,Service $service)
    {
        //
        $service->create($request->all());
        return redirect('services')->with('success','The service is in the sistem now');

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
        if($service->clients()->count() >0){

          return redirect('services')->with('primary','The service is in use for one or more clients');
        }else{
          $service->delete();
          return redirect('services')->with('info','The service is delete');

        }



    }
}
