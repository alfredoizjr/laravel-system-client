
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

          <div class="card"><!--head panel-->
            <div class="card-body">
               <p><i class="fa fa-smile-o" aria-hidden="true"></i> Profile\ {{Auth::user()->name}}</p>
            </div>
          </div><!--head panel-->
          <!--if is worker shoe this view-->
          <div class="col-md-4">
            <div class="card">
              <div class="card-body">
                <div class="card-avatar">
                  <a href="{{route('profile.create')}}"><img src="/files/avatars/{{Auth::user()->avatar}}" alt="" /></a>
                </div>
                <br>
                 <p>
                  <i class="fa fa-user" aria-hidden="true"></i> {{Auth::user()->email}}
                 </p>
                 <div class="divider"></div>
                 <p>
                   <i class="fa fa-unlock-alt" aria-hidden="true"></i> {{Auth::user()->roles}}
                 </p>
                 <div class="divider"></div>
                 <br>
                 <p class="text-center">
                    <a href="{{url('close-task')}}"><span class="label label-success">close task {{$tasks_close}}</span></a> \
                    <a href="{{url('task')}}"><span class="label label-info">Open Task {{$task_open}}</span></a>
                 </p>
                <div class="divider"></div>
                <p>My cLients</p>
                @if($user->clients->count() > 0)
                   @foreach($user->clients as $user)
                    <p><a class="btn btn-sm" href="{{url('folder',$user->id)}}">{{$user->business_name}} \ <i class="fa fa-clock-o" aria-hidden="true"></i>{{$user->created_at->toFormattedDateString()}}</a></p>
                   @endforeach
                   @else
                   <br>
                   <p class="text-center">
                      <i class="fa fa-exclamation" aria-hidden="true"></i> <i>No found any clients for this worker</i>
                   </p>
                   @endif
              </div>
              <div class="card-footer">
                <br>
                 <a title="Edit data" class="btn btn-raised btn-warning" href="{{route('profile.edit',Auth::user()->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-8">

            <div class="card">
              <div class="border-card-primary"></div>
              <div class="card-body">

                <p>
                  If you change the password make sure you can remenber if you dont, them you can use the forget password for help
                </p>

                <a class="btn btn-raised btn-success"  href="{{url('change-password-form')}}"><i class="fa fa-pencil" aria-hidden="true"></i> Change pasword</a>

              </div>

            </div>

          </div>
          <div class="col-md-8">

            <div class="card">
              <div class="border-card-primary"></div>
              <div class="card-body">
                <p>
                Profile Avatar this is obtianal meka sure you pic for upload is no more big them 1 mb thanks
                </p>
                <a class="btn btn-raised btn-info"  href="{{route('profile.create')}}"><i class="fa fa-picture-o" aria-hidden="true"></i> Upload avatar</a>

              </div>

            </div>

          </div>

          <!--if is admin shoe this view--------------------------------------------------------------------------------->

@endsection
@section('script')
<script type="text/javascript">
@if (notify()->ready())

alertify.success( '{{ notify()->message() }}' );

@endif
</script>

@endsection
