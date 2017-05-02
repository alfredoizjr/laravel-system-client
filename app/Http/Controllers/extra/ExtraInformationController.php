<?php

namespace App\Http\Controllers\extra;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExtraRequest;
use App\Http\Requests\BusinessDirectoryRequest;
use App\Http\Requests\ExtraResourceRequest;
use App\Extra;
use App\ExternalLink;
use App\BussinessDirectoryListing;
use App\HistoryClient;
use Auth;

class ExtraInformationController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }


    /**
     * Show the form for creating a domain info.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert_domain_name($id)
    {
        //
        $data = new Extra;
        return view('extra.create',['data'=>$data,'id'=>$id]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExtraRequest $request)
    {
        $extra = Extra::where('client_id',$request->client_id);
        if($extra->count()>0){
          return redirect()->route('folder',$request->client_id)->with('warning','this client already have a domain');
        }
        /*register for the history*/
        $history = new HistoryClient;
        $history->client_id = $request->client_id;
        $history->description = "Creation of Domain Name settings";
        $history->accion = "creation";
        $history->user = Auth::user()->name;
        $history->avatar = Auth::user()->avatar;
        $history->save();
       /*register for the history*/

        Extra::create($request->all());
        notify()->flash('the domain information was inserted!', 'success');
        return redirect()->route('folder',$request->client_id);


    }


        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show_domain_name(Extra $extra,$id)
        {
            //
            $extra = $extra::find($id);
            return view('extra.edit',['data'=>$extra]);


        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function update_domain_name(Request $request, $id)
        {
            //
            $history = new HistoryClient;
            $history->client_id = $request->client_id;
            $history->description = "Domain Information has been edited !  ";
            $history->accion = "edited";
            $history->user = Auth::user()->name;
            $history->avatar = Auth::user()->avatar;
            $history->save();

            $extra = Extra::find($id)->update($request->all());
            notify()->flash('the information was updated!', 'success');
            return back()->withInput();
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy_domain_name($id)
        {
            //

            $history = new HistoryClient;
            $history->client_id = Extra::find($id)->client_id;
            $history->description = "Domain Information has been deleted !  ";
            $history->accion = "deleted";
            $history->user = Auth::user()->name;
            $history->avatar = Auth::user()->avatar;
            $history->save();

            Extra::destroy($id);
            notify()->flash('the information was deleted!', 'success');
            return back()->withInput()->with('success','The data was delete');
        }


    /**
     * Show the form for creating a extra info like Feebee.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert_extra_resource($id)
    {
        //

        $data = new ExternalLink;
        return view('extra.extra_resource',['data'=>$data,'id'=>$id]);

    }

    /**
     * Store a newly created resource in storage extra resource like feebe.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_extra_resource(ExtraResourceRequest $request)
    {

        $extra = ExternalLink::where('client_id',$request->client_id);
        if($extra->count()>0){
        return redirect()->route('folder',$request->client_id)->with('warning','this client akready have a domain');
        }

        ExternalLink::create($request->all());
        $history = new HistoryClient;
        $history->client_id = $request->client_id;
        $history->description = "Creation of feebee account";
        $history->accion = "creation";
        $history->user = Auth::user()->name;
        $history->avatar = Auth::user()->avatar;
        $history->save();
        notify()->flash('Feebee Information was Insert!', 'success');
        return redirect()->route('folder',$request->client_id);


    }

    public function show_extra_resource(ExternalLink $externalLink,$id)
    {
        //

        $externalLink = $externalLink::find($id);
        return view('extra.edit_extra_resource',['data'=>$externalLink]);


    }


    public function update_extra_resource(ExtraResourceRequest $request, $id)
    {
        //
        $history = new HistoryClient;
        $history->client_id = $request->client_id;
        $history->description = "Updated of feebee account";
        $history->accion = "updated";
        $history->user = Auth::user()->name;
        $history->avatar = Auth::user()->avatar;
        $history->save();
        $extra = ExternalLink::find($id)->update($request->all());
        notify()->flash('Feebee Information was Insert!', 'success');
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_extra_resource($id)
    {
        //
        $history = new HistoryClient;
        $history->client_id = ExternalLink::find($id)->client_id;
        $history->description = "Feebee Information has been deleted !  ";
        $history->accion = "deleted";
        $history->user = Auth::user()->name;
        $history->avatar = Auth::user()->avatar;
        $history->save();
        ExternalLink::destroy($id);
        notify()->flash('Feebee Information was deleted!', 'success');
        return back()->withInput();
    }

    /**
     * Show the form for creating a domain info.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert_business_directory($id)
    {
        //
        $data = new BussinessDirectoryListing;
        return view('extra.create_business_directory',['data'=>$data,'id'=>$id]);

    }

    public function store_business_directory(BusinessDirectoryRequest $request)
    {

        $extra = BussinessDirectoryListing::where('client_id',$request->client_id);
        if($extra->count()>0){
        return redirect()->route('folder',$request->client_id)->with('warning','this client already have a domain');
      }else{

        $history = new HistoryClient;
        $history->client_id = $request->client_id;
        $history->description = "Created Business Directory Listing";
        $history->accion = "Create";
        $history->user = Auth::user()->name;
        $history->avatar = Auth::user()->avatar;
        $history->save();

        $directory = new BussinessDirectoryListing;
        $directory->login_website = $request->login_website;
        $directory->name_listing = $request->name_listing;
        $directory->email = $request->email;
        $directory->password = $request->password;
        $directory->sucribed = $request->sucribed;
        $directory->long = $request->long;
        $directory->expire = date('Y-m-d',strtotime($request->long));
        $directory->client_id = $request->client_id;
        $directory->save();
        notify()->flash('Directory Listing Information was Insert!', 'success');
        return redirect()->route('folder',$request->client_id);
      }

    }

    public function show_business_directory(BussinessDirectoryListing $directory,$id)
    {
        //

        $directory = $directory::find($id);
        return view('extra.edit_business_directory',['data'=>$directory]);


    }

    public function update_business_directory(Request $request, $id)
    {
        //
        $history = new HistoryClient;
        $history->client_id = $request->client_id;
        $history->description = "Updated Business Directory Listing!";
        $history->accion = "Update";
        $history->user = Auth::user()->name;
        $history->avatar = Auth::user()->avatar;
        $history->save();
        BussinessDirectoryListing::find($id)->update($request->all());
        notify()->flash('Directory Listing Information was updated!', 'success');
        return back()->withInput();
    }

    public function destroy_business_directory($id)
    {
        //
        $history = new HistoryClient;
        $history->client_id = BussinessDirectoryListing::find($id)->client_id;
        $history->description = "Directory business listing Information has been deleted ! ";
        $history->accion = "deleted";
        $history->user = Auth::user()->name;
        $history->avatar = Auth::user()->avatar;
        $history->save();
        BussinessDirectoryListing::destroy($id);
        notify()->flash('Directory Listing information was delete!', 'success');
        return back()->withInput()->with('success','The data was delete');
    }

}
