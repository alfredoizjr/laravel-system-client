@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <br>
<div class="col-md-6 col-md-offset-3">

<div class="card">
    <div class="text-center card-heading card-success"><p><i class="fa fa-globe" aria-hidden="true"></i> Edit data for Directory Listing</p></div>
<div class="card-body">
   @include('layouts.alert_success')
   @include('layouts.errors')
   {!!Form::model($data,['url' => ['extra/update-business-directory',$data->id],'method'=>'POST'])!!}
  <div class="modal-body">
       {{Form::text('login_website',$data->login_website,['class' => 'form-control','placeholder'=>'Login website '])}}
       {{Form::hidden('client_id',$data->client_id)}}
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
  <div class="pull-right">
    <a class="btn  btn-raised btn-danger" href="{{url('folder',$data->client_id)}}">Back</a>
    <button type="submit" class="btn  btn-raised btn-info">Save changes</button>
  </div>
{!!Form::close()!!}

</div>

</div>
  </div>
  </div>
@endsection
@section('script')
<script type="text/javascript">
@if (notify()->ready())
 alertify.success( '{{ notify()->message() }}' );
@endif
</script>
@endsection
