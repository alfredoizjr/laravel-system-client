@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">



         <div class="card">
             <div class="card-heading card-warning"><p><i class="fa fa-user fa-2x" aria-hidden="true"></i> Change Password</p></div>

             <div class="card-body">
              @include('layouts.errors')
              @include('layouts.alert_info')
             {!!Form::open(['url' => 'change-password', 'method' => 'POST'])!!}
             <div class="form-group">
               {{Form::password('password',['class' => 'form-control','placeholder'=>'New Password'])}}
             </div>
              <div class="form-group">
                {{Form::password('password_confirmation',['class' => 'form-control','placeholder'=>'Repeat New Password'])}}
              </div>

              <div class="pull-right">
                <a class='btn btn-raised btn-warning' href="{{url('profile')}}">cancel</a>
                {{Form::submit('Send',['class'=>'btn btn-raised btn-success'])}}
              </div>
             {!!Form::close()!!}



                </div>
            </div>


        </div>
    </div>
</div>
@endsection
