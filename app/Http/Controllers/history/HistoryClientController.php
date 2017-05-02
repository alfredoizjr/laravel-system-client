<?php

namespace App\Http\Controllers\history;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Client;
use Auth;
use App\HistoryClient;

class HistoryClientController extends Controller
{
  public function __construct()
  {

      $this->middleware('auth');
      $this->middleware('Admin');
  }

  public function show($id){

      $data = HistoryClient::where('client_id','=',$id)->orderBy('created_at', 'desc')->paginate(10);
      $back = $id;
      return view('history.show',['data'=>$data,'back'=>$back]);
  }

  public function search(Request $request){

 if($request->ajax()) {
   $envio = Input::get('body');
      $history = HistoryClient::where('accion','LIKE','%'.$envio.'%')->get();


  return  response()->json(['message' => $history->toArray()]);
    }
  }

}
