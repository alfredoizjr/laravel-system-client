@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <br>

<div class="col-md-6 col-md-offset-3">


<div class="card">
    <div class="text-center card-heading card-success"><p><i class="fa fa-quote-right" aria-hidden="true"></i> Extra resource</p></div>
<div class="card-body">
   @include('layouts.errors')
   {!!Form::open(['url' => 'extra-resource-insert', 'method' => 'POST'])!!}




   <div class="modal-body">

       {{Form::text('login_website','http://www.feebee.com',['class' => 'form-control','placeholder'=>'Feebee'])}}
       {{Form::hidden('client_id',$id)}}
   </div>
   <div class="modal-body">

       {{Form::text('email',$data->email,['class' => 'form-control','placeholder'=>'Email User'])}}

   </div>
   <div class="modal-body">

       {{Form::text('password',$data->password,['class' => 'form-control','placeholder'=>'Password'])}}

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
</div>
@endsection
