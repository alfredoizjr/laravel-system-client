@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

          <div class="card"><!--head panel-->
            <div class="card-body">
               <p><i class="fa fa-universal-access" aria-hidden="true"></i>
                 User Panel \  <span class="label label-success"> administrators {{$user::where('roles','admin')->count()}}</span>
                 <span class="label label-primary"> workers {{$user::where('roles','worker')->count()}}</span>
               </p>
            </div>
          </div><!--head panel-->
         <!--table users-->
         @include('layouts.alert_success')

          <!--table list clients-->

          @foreach($user->all() as $user)
          @if($user->id != Auth::user()->id)
            <div class="col-md-6">
               <div class="card">
                 <div class="card-body">
                   <div class="col-md-3">
                     <a title="See this profile" href="{{route('profile.show',$user->id)}}" class="thumbnail">
                         <img src="/files/avatars/{{$user->avatar}}" alt="...">
                     </a>
                     <span class="label label-info"> Current task {{$user_task = $user::find($user->id)->tasks->count()}}</span>
                    <span class="label label-primary"> Clients {{$user_task = $user::find($user->id)->clients->count()}}</span>
                   </div>
                   <div class="col-md-9">
                    <p>
                      <i class="fa fa-user" aria-hidden="true"></i> {{$user->name}}
                    </p>
                    <p>
                      <i class="fa fa-envelope" aria-hidden="true"></i> {{$user->email}}
                    </p>

                    @if($user->roles === 'admin')
                    <span class="label label-success">{{$user->roles}}</span>
                    @else
                    <span class="label label-default">{{$user->roles}}</span>
                    @endif
                   </div>
                 </div>
                 <div class="card-footer">
                   <br>
                   <a class="btn btn-raised btn-warning btn-xs" href="{{route('user.edit',$user->id)}}"><i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i></a>
                  <a onclick="del()" class="btn btn-raised btn-danger btn-xs" href="#"><i class="fa fa-trash fa-1x" aria-hidden="true"></i></a>
                  @if($user->roles != 'admin')
                   <a title="make this user admin" class="btn btn-raised btn-default btn-xs" href="{{url('get-admin',$user->id)}}"><i class="fa fa-unlock-alt fa-1x" aria-hidden="true"></i></a>
                   @else
                   <a title="remove admin permission" class="btn btn-raised btn-default btn-xs" href="{{url('remove-admin',$user->id)}}"><i class="fa fa-lock fa-1x" aria-hidden="true"></i></a>
                   @endif
                 </div>

               </div>
                @endif
            </div>
            <script type="text/javascript">

            function del() {
               swal({
                     title: "Are you sure?",
                      text: "{{$user->id}}You will not be able to recover this task for the future!",
                      type: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#DD6B55",
                       confirmButtonText: "Yes, delete it!",
                       cancelButtonText: "No, cancel please!",
                       closeOnConfirm: false,
                       closeOnCancel: false
                     },
                       function(isConfirm){
                         if (isConfirm) {

                           location.href = "{{url('user-delete',$user->id)}}"

                         } else {
                           swal("Cancelled", "the request was cancelled", "error");
                         }
                         });
            }

            </script>
         @endforeach
            <!--btn float user owner-->
          <div class="cont-btn">
          <a class='flotante btn-circle-success botonF1' href='#' ><i class="material-icons">person_pin</i></a>
          <a class='flotante main-btn botonF2' href="{{route('user.create')}}" ><i class="material-icons">add</i></a>

          </div>
    </div>

</div>
@endsection
@section('script')
<script type="text/javascript">
@if (notify()->ready())
 swal({
     title: "{{ notify()->message() }}",
     type: "{{ notify()->type() }}",
     timer: 1500,
      showConfirmButton: false
   });
@endif
</script>

@endsection
