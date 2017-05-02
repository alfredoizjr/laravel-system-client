<nav class="navbar navbar-default  navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-left">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else


                    <li><a title="Dashboard" href="{{ url('/home') }}"><i class="fa fa-tachometer fa-2x" aria-hidden="true"></i></a></li>
                    <li class="dropdown"><!--list obtions drop dw-->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-th-list fa-2x" aria-hidden="true"></i>
                        </a>

                        <ul class="dropdown-menu" role="menu">

                          <li><a title="List Clients" href="{{url('clients')}}">Clients list</a></li>
                            <li><a title="Inser a new one" href="{{url('clients/create')}}">Create Client</a></li>
                            <li><a title="see the tasks is open" href="{{url('task')}}">tasks</a></li>
                            <li><a title="Inser a new one" href="{{url('task/create')}}">Create a Task</a></li>
                            <li><a title="Inser a new one" href="{{url('reminder')}}">My Reminders</a></li>
                            <li><a title="Inser a new one" href="{{url('reminder/create')}}">Create a Reminders</a></li>
                        </ul>
                    </li><!--list obtions drop dw-->
                    @if(Auth::user()->roles ==='admin')
                    <li class="dropdown"><!--list setting drop dw-->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-cog fa-2x" aria-hidden="true"></i>
                        </a>

                        <ul class="dropdown-menu" role="menu">

                          <li><a title="List Clients" href="{{url('services')}}">Add Services</a></li>
                         <li><a title="List Clients" href="{{url('user')}}">Users</a></li>
                         <li><a title="List Clients" href="{{route('user.create')}}">Add user</a></li>
                         <li><a title="List Clients" href="{{url('request')}}">Request list</a></li>
                         <li><a title="List Clients" href="{{route('request.create')}}">Send a request</a></li>
                        </ul>
                    </li><!--list setting drop dw-->
                    @endif
             </ul>
            <ul class="nav navbar-nav navbar-right">
              <li class="nav navbar-left">
              <a href="#"><span class="label label-primary"><i class="fa fa-coffee" aria-hidden="true"></i> BETA</span></a>
              </li>
              <li class="nav navbar-left">
            <a title="my Profile" href="{{url('profile')}}"><img id="thubnail-circ" src="/files/avatars/{{Auth::user()->avatar}}"></a>
          </li>
              <li class="nav navbar-left">
            <a title="Send Email" href="{{url('email')}}"><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i></a>
          </li>
                <li class="nav navbar-left">
              <a title="Open task" href="{{url('task')}}"><i class="fa fa-bell-o fa-2x" aria-hidden="true"></i><span class="label label-info">{{$open_task}}</span></a>
              </li>
              <li>
                @if($open_request > 0)
                <a title="You have Request" href="{{url('request-user')}}"><i class="fa fa-bullhorn fa-2x" aria-hidden="true"></i><span class="label label-danger">{{$open_request}}</span></a>
               @endif
              </li>

            <li class="nav navbar-left">
                <a title="Log out" href="{{ url('/logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out fa-2x" aria-hidden="true"></i>
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
          </ul>
              @endif
        </div>
    </div>
</nav>
