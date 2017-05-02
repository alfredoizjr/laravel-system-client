@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <br>
<div class="col-md-6 col-md-offset-3">

<div class="card">
    <div class="text-center card-heading card-success"><p><i class="fa fa-globe" aria-hidden="true"></i> Insert data for Directory Listing</p></div>
<div class="card-body">
   @include('layouts.errors')
   {!!Form::open(['url' => 'extra/store-domain-name', 'method' => 'POST'])!!}
  <div class="modal-body">
       {{Form::text('login_website',$data->login_website,['class' => 'form-control','placeholder'=>'Login website '])}}
       {{Form::hidden('client_id',$id)}}
   </div>
   <div class="modal-body">
        {{Form::text('name_listing',$data->name_listing,['class' => 'form-control','placeholder'=>'Name Listing'])}}
    </div>
    <div class="modal-body">
         {{Form::text('email',$data->email,['class' => 'form-control','placeholder'=>'Email'])}}
     </div>
     <div class="modal-body">
          {{Form::text('password',$data->password,['class' => 'form-control','placeholder'=>'Password'])}}
      </div>
      <div class="modal-body">
           {{Form::text('sucribed',date('Y-m-d'),['class' => 'form-control','placeholder'=>'Subscribed'])}}
       </div>
       <div class="modal-body">
            {{Form::text('long',$data->long,['class' => 'form-control','placeholder'=>'For how Long'])}}
        </div>
        <div class="input-group date col-md-4">
          <input type="text" id="fecha" name="expire" class="form-control" value="{{date('m/d/Y')}}"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
       </div>
  <div class="pull-right">
    <a class="btn  btn-raised btn-danger" href="{{url('folder',$id)}}">Cancel</a>
    <button type="submit" class="btn  btn-raised btn-info">Save changes</button>
  </div>
{!!Form::close()!!}

</div>

</div>
  </div>
  </div>
@endsection
