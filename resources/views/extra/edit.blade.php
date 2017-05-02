@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <br>


<div class="card">
    <div class="text-center card-heading card-success"><p><i class="fa fa-desktop" aria-hidden="true"></i> Edit Domain Information</p></div>
<div class="card-body">
   @include('layouts.alert_success')
   @include('layouts.errors')
    {!!Form::model($data,['url' => ['extra/update-domain-name',$data->id],'method'=>'POST'])!!}
<div class="col-md-6">



   <div class="modal-body">

       {{Form::text('web_url',$data->web_url,['class' => 'form-control','placeholder'=>'Domain name '])}}
       {{Form::hidden('client_id',$data->client_id)}}
   </div>
   <div class="modal-body">
       {{Form::text('hosting_info',$data->hosting_info,['class' => 'form-control','placeholder'=>'Hosting Info'])}}
   </div>
   <div class="modal-body">
       {{Form::text('hosting_user',$data->hosting_user,['class' => 'form-control','placeholder'=>'Hosting Account'])}}
   </div>
   <div class="modal-body">
       {{Form::text('hosting_password',$data->hosting_password,['class' => 'form-control','placeholder'=>'Hosting Account Password'])}}
   </div>
   <div class="modal-body">
       {{Form::text('pin',$data->pin,['class' => 'form-control','placeholder'=>'Hosting Account Pin'])}}
   </div>

  </div>

  <div class="col-md-6">
    <div class="modal-body">
        {{Form::text('Cpanel',$data->Cpanel,['class' => 'form-control','placeholder'=>'Cpanel User'])}}
    </div>
    <div class="modal-body">
        {{Form::text('Cpanel_password',$data->Cpanel_password,['class' => 'form-control','placeholder'=>'Cpanel Password'])}}
    </div>
    <div class="modal-body">
        {{Form::text('email_one',$data->email_one,['class' => 'form-control','placeholder'=>'Email'])}}
    </div>
    <div class="modal-body">
        {{Form::text('email_two',$data->email_two,['class' => 'form-control','placeholder'=>'Email two'])}}
    </div>
    <div class="modal-body">
        {{Form::text('email_password',$data->email_password,['class' => 'form-control','placeholder'=>'Email password account'])}}
    </div>


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
