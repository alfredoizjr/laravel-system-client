<?php

namespace App\Http\Controllers\email;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Mail\ClientEmail;
use App\contact;
use App\Http\Controllers\Controller;

class EmailClientsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
      $array = array();
       $contacts = $request->user()->contacts;
       foreach ($contacts as  $contact) {
         array_push($array,$contact->email);
       }

       return view('email.index',['array'=>$array,'contacts'=>$contacts]);

    }

    public function emailData(Request $request)
    {
      return view('email.index',$request->all());
    }

    public function sendEmail(Request $request)
    {
      Mail::to($request->to)->send(new ClientEmail($request->content , $request->title));
      return redirect('email')->with('success','Your email was send thaks');

    }
}
