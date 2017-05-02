<?php

namespace App\Http\Controllers\date;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoDateRequest;
use App\Do_date;
class DoDateController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Do_date $date)
    {
        //
        $date->client_id = $request->client_id;
        $date->expire = date('Y-m-d',strtotime($request->expire));
        $date->note = $request->note;
        $date->save();
        return redirect()->route('folder',$request->client_id)->with('success', 'the date was insert');

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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DoDateRequest $request, Do_date $do_date)
    {
        //
        $do_date->client_id = $request->client_id;
        $do_date->expire = date('Y-m-d',strtotime($request->expire));
        $do_date->note = $request->note;
        $do_date->save();
        return back()->withInput();

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
