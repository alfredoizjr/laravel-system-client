@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="card"><!--head panel-->
        <div class="card-body">
           <p><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard \ {{Auth::user()->name}}</p>
        </div>
      </div><!--head panel-->
      <div class="col-md-4"><!--Panel user is worker  profile-->
          <div class="card">

                  <div class="border-card-primary"> </div>
                 <div class="card-body">

                     <p class= "text-center"><i class="fa fa-user-circle" aria-hidden="true"></i> My Profile</p>

                   <div class="text-center col-md-6 make-spaces">
                     <a href="{{url('profile')}}" class="thumbnail">
                         <img src="/files/avatars/{{Auth::user()->avatar}}" alt="...">
                     </a>
                   </div>
                   <div class="text-center col-md-6 make-spaces">
                    <a href="{{url('/task')}}"> <span class="label label-info">Current task {{$task_i_have}}</span> </a>
                    <br>
                    <div class="divider"></div>
                    <br>
                    <a href="#"> <span class="label label-success">Clients I have {{$clients_i_have}}</span> </a>

                   </div>
                </ul>
               </div>
          </div>
      </div>
        <div class="col-md-4"><!--Panel clients-->
            <div class="card">
                <div class="text-center card-heading card-success"><p><i class="fa fa-users" aria-hidden="true"></i> Clients</p></div>

                <div class="card-body text-center">

                   <p>Clients Manager</p>
                   <div class="text-center col-md-6 make-spaces">
                    <a href="{{url('clients/create')}}"><p><i class="fa fa-user-plus fa-2x" aria-hidden="true"></i></p><p>Add Client</p></a>
                   </div>
                   <div class="text-center col-md-6 make-spaces">
                    <a href="{{url('clients')}}"><p><i class="fa fa-users fa-2x" aria-hidden="true"></i></p><p>Clients</p></a>
                   </div>
                </div>
            </div>
        </div><!--Panel clients-->
        <div class="col-md-4"><!--Panel task clients-->
            <div class="card">

                    <div class="card-heading card-primary"><p class="text-center"><i class="fa fa-tasks fa " aria-hidden="true"></i> Tasks</p></div>
                   <div class="card-body">
                     <p class="text-center">
                       Tasks Manager
                     </p>
                     <div class="text-center col-md-6 make-spaces">
                      <a href="{{url('task/create')}}"><p><i class="fa fa-tasks fa-2x" aria-hidden="true"></i></p><p>Create task</p></a>
                     </div>
                     <div class="text-center col-md-6 make-spaces">
                      <a href="{{url('/task')}}"><p><i class="fa fa-bell-o fa-2x" aria-hidden="true"></i></p><p>My tasks</p></a>

                     </div>
                  </ul>
                 </div>
            </div>
        </div>

        @if(Auth::user()->roles ==="admin")

        <div class="col-md-4"><!--Panel  user is admin -->
            <div class="card">

                    <div class="card-heading card-info"><p class="text-center"><i class="fa fa-universal-access"></i> Users</p></div>
                   <div class="card-body">
                     <p class="text-center">
                        Users Manager
                     </p>
                     <div class="text-center col-md-6 make-spaces">
                      <a href="{{route('user.create')}}"><p><i class="fa fa-plus fa-2x" aria-hidden="true"></i><p>Add User</p></a>
                     </div>
                     <div class="text-center col-md-6 make-spaces">
                      <a href="{{url('user')}}"><p><i class="fa fa-universal-access fa-2x" aria-hidden="true"></i></p><p>Users</p></a>

                     </div>
                  </ul>
                 </div>
            </div>
        </div>
        <div class="col-md-4"><!--Panel  user is admin -->
            <div class="card">

                    <div class="card-heading card-danger"><p class="text-center"><i class="fa fa-clock-o" aria-hidden="true"></i> Pass due date</p></div>
                   <div class="card-body">
                     <p class="text-center">
                       Listing of clients with pass do date
                     </p>
                     <div class="text-center col-md-12 make-spaces">
                      <a href="{{url('clients')}}"><p><i class="fa fa-clock-o fa-2x" aria-hidden="true"></i></p><span class="label label-danger">{{$do_date->count()}}</span></a>

                     </div>
                  </ul>
                 </div>
            </div>
        </div>

        @endif
          @if($the_request > 0)
          <div class="col-md-4"><!--Panel  if have the any request-->
              <div class="card">

                      <div class="card-heading card-danger"><p class="text-center"><i class="fa fa-bullhorn" aria-hidden="true"></i> Request</p></div>
                     <div class="card-body">
                       <p class="text-center">
                         You have request need your atention
                       </p>
                       <div class="text-center col-md-12 make-spaces">
                        <a href="{{url('request-user')}}"><p><i class="fa fa-bullhorn fa-2x" aria-hidden="true"></i><p>{{$the_request}}</p></a>
                       </div>

                    </ul>
                   </div>
              </div>
          </div>
          @endif
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
@if (notify()->ready())
 swal({
     title: "{{ notify()->message() }}",
     type: "{{ notify()->type() }}",
     text: "{{Auth::user()->name}}",
     imageUrl: "/files/avatars/{{Auth::user()->avatar}}",
     timer: 2000,
      showConfirmButton: false
   });
@endif
</script>

@endsection
