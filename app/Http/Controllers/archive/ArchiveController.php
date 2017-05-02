<?php

namespace App\Http\Controllers\archive;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ArchiveTask;
use Auth;
use Storage;
use File;

class ArchiveController extends Controller
{
    //
    public function delete($id){
      $archive = ArchiveTask::find($id);
      File::delete('files/archives/'.$archive->name_archive);
      $archive->delete();
        notify()->flash('The item was deleted', 'success');
      return back()->withInput();
    }

    public function add(Request $request){
      if($request->hasFile('archive')){
        $temp = $request->file('archive');
        $original =$request->file('archive')->getClientOriginalName();
        $ext = $request->file('archive')->getClientOriginalExtension();
        $name = $request->id."_".$original;
        Storage::disk('archives')->put($name,File::get($temp));
        $archive = new ArchiveTask;
        $archive->name_archive =  $name;
        $archive->ext_archive  =  $ext;
        $archive->original     =  $original;
        $archive->task_id      =  $request->task_id;
        $archive->save();
        notify()->flash('The item was inserted', 'success');
      return back()->withInput();
    }else{
    notify()->flash('Pick a archive for add', 'warning');
    return back()->withInput();
    }

    }

}
