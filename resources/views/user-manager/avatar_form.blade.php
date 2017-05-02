@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

          <div class="card"><!--head panel-->
            <div class="card-body">
               <p><i class="fa fa-picture-o" aria-hidden="true"></i> Manager avatar for \ {{Auth::user()->name}}</p>
            </div>
          </div><!--head panel-->
          <div class="col-md-6 col-md-offset-3">
            <div class="card">
              <div class="card-heading card-primary"><h3><i class="fa fa-picture-o" aria-hidden="true"></i> Avatar</h3></div>
              <form class="" action="{{url('avatar')}}" method="post" enctype="multipart/form-data" method="post">
                <div class="card-body">
                  {{ csrf_field() }}
                   <label>Upload your avatar</label>
                       <input type="file" name="avatar" value="">
                   <div class="pull-right">
                       <a  class="btn btn-raised btn-danger" name="button" href="{{url('profile')}}">Cancel</a>
                       <button type="submit" class="btn btn-raised btn-success" name="button">Upload</button>
                   </div>
                </div>
             </form>
            </div>
          </div>
      </div>
</div>
@endsection
