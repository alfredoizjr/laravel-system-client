@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <br>

<div class="col-md-6 col-md-offset-3">


<div class="card">
    <div class="text-center card-heading card-success"><p><i class="fa fa-quote-right" aria-hidden="true"></i> Extra resource</p></div>
<div class="card-body">
  @include('layouts.alert_success')
   @include('layouts.errors')
     {!!Form::model($data,['url' => ['extra/update-extra-resource',$data->id],'method'=>'POST'])!!}




   <div class="modal-body">

       {{Form::text('login_website',$data->login_website,['class' => 'form-control','placeholder'=>'Feebee'])}}
       {{Form::hidden('client_id',$data->client_id)}}
   </div>
   <div class="modal-body">

       {{Form::text('email',$data->email,['class' => 'form-control','placeholder'=>'Email User'])}}

   </div>
   <div class="modal-body">

       {{Form::text('password',$data->password,['class' => 'form-control','placeholder'=>'Password'])}}

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
</div>
@endsection
@section('script')
<script type="text/javascript">
@if (notify()->ready())
 alertify.success( '{{ notify()->message() }}' );
@endif
</script>
@endsection
