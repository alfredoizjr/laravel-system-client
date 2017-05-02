@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">


    <div class="card"><!--head panel-->
      <div class="card-body">
          <p><i class="fa fa-folder-open" aria-hidden="true"></i> {{$data->business_name}} <a class="btn btn-raised btn-info" href="{{url('clients')}}"><i class="fa fa-list" aria-hidden="true"></i> back to the list</a>
           @if(Auth::user()->roles ==="admin")
              <a class="btn btn-raised btn-warning" href="{{url('history',$data->id)}}"><i class="fa fa-free-code-camp" aria-hidden="true"></i> see the history</a>
           @endif
          </p>
       </div>
    </div><!--head panel-->
    <div class="col-md-3"><!--panel uno-->
  <div class="card">
    <div class="card-body">
             <div class="card-avatar">
                  <img src="/files/avatars/{{$data->avatar}}" alt="" />
             </div>
             <div class="card-body">
                  <h5>{{$data->business_name}}</h5>
                  <div class="divider"></div>
                  <p><i class="fa fa-hashtag" aria-hidden="true"></i> {{$data->business_account}}</p>
                  <p><i class="fa fa-user" aria-hidden="true"></i> {{$data->name}} {{$data->Last}}</p>
                  <p><i class="fa fa-phone" aria-hidden="true"></i>
                  {{'('.substr($data->business_phone, 0, 3).') '.substr($data->business_phone, 3, 3).' '.substr($data->business_phone, 6, 4)}}
                  </p>
                  <p>
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    {{$data->business_email}}
                  </p>
                  <p><!--form for send email to client-->
                   {!!Form::open(['url' => 'send-to', 'method' => 'POST'])!!}
                     <div class="form-group">
                       {{Form::hidden('data',$data->business_email)}}
                     </div>

                         <button class="btn btn-block btn-success btn-raised" type="submit" name="send"><i class="material-icons">email</i></button>

                    {!!Form::close()!!}
                  </p><!--form for send email to client-->
                  <br>

                <div class="divider"></div>
                  <h5>Business Address<h5>
                    <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$data->business_address}} {{$data->business_zip}},{{$data->state}}</p>
                </div>

    </div>
</div>

<div class="card"><!--extra info-->
  <div class="border-card-primary"></div>
    <div class="card-body">
      <h4>Information</h4>
      @if(!$extra->extra)
      <a href="{{url('extra/create',$data->id)}}" class="btn btn-block btn-raised btn-info">Domain name</a>
      @else
       <a href="{{url('extra/create',$data->id)}}" class="btn btn-block btn-raised btn-info disabled">Domain name</a>
      @endif
      @if(!$extra->external_links)
      <a href="{{url('extra-resource/create',$data->id)}}" class="btn btn-block btn-raised btn-primary">Extra Resource</a>
      @else
        <a href="{{url('extra-resource/create',$data->id)}}" class="btn btn-block btn-raised btn-primary disabled">Extra Resource</a>
      @endif
      @if(!$extra->bussine)
      <a href="{{url('extra/show-bisiness-directory',$data->id)}}" class="btn btn-block btn-raised btn-success">Directory Listing</a>
      @else
        <a href="{{url('extra/show-bisiness-directory',$data->id)}}" class="btn btn-block btn-raised btn-success disabled">Directory Listing</a>
      @endif
    </div>

</div><!--extra info-->

    </div><!--panen uno-->

    <div class="col-md-9"><!--panen service-->
        @include('layouts.alert_success')
        @include('layouts.errors')
    @if(Auth::user()->roles === 'admin')
      <div class="card">
        <div class="card-body">
          @if(!$data->do_date)<!--if dont have relation object-->
           <form action="{{route('do-date.store')}}" method="post">
             {{ csrf_field() }}

             <div class="input-group date col-md-4">
               <input type="text" id="fecha" name="expire" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
            </div>

              <input type="hidden" name="client_id" value="{{$data->id}}" >
             <input type="text" id="fecha" name="note" placeholder="note" class="form-control">
             <button type="submit" class="btn btn-raised btn-default">Send</button>
           </form>
           @else
           @if($data->do_date->expire == date('Y-m-d'))<!--if do date is alrady-->
           <p>
            <i class="fa fa-table" aria-hidden="true"></i> {{$data->do_date->expire}} {{$data->do_date->note}}
             / <span class='label label-danger'>Pass do date</span> <a class=" btn btn-raised btn-primary" role="button" data-toggle="collapse" href="#other" aria-expanded="false" aria-controls="other"><i class="fa fa-pencil" aria-hidden="true"></i></a>
           </p>

           <div class="collapse" id="other"><!--colapse zone-->
             <div class="">
               {!!Form::model($data->do_date,['route' => ['do-date.update', $data->do_date->id],'method'=>'PUT'])!!}

                 <div class="input-group date col-md-4">
                   <input type="text" id="fecha" name="expire" class="form-control" value="{{date('m/d/Y',strtotime($data->do_date->expire))}}"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div>

                  <input type="hidden" name="client_id" value="{{$data->id}}" >
                 <input type="text" id="fecha" name="note" placeholder="note" class="form-control" value="{{$data->do_date->note}}">
                 <button type="submit" class="btn btn-raised btn-default">Send</button>
                {!!Form::close()!!}
            </div>
           </div>
           @else
           <p class="danger">
            <i class="fa fa-table" aria-hidden="true"></i> {{$data->do_date->expire}} {{$data->do_date->note}}
              <a class=" btn btn-raised  btn-primary" role="button" data-toggle="collapse" href="#other" aria-expanded="false" aria-controls="other"><i class="fa fa-pencil" aria-hidden="true"></i></a>
           </p>

            <div class="collapse" id="other"><!--colapse zone-->
              <div class="">
              {!!Form::model($data->do_date,['route' => ['do-date.update', $data->do_date->id],'method'=>'PUT'])!!}

                  <div class="input-group date col-md-4">
                    <input type="text" id="fecha" name="expire" class="form-control" value="{{date('m/d/Y',strtotime($data->do_date->expire))}}"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                 </div>

                   <input type="hidden" name="client_id" value="{{$data->id}}" >
                  <input type="text" id="fecha" name="note" placeholder="note" class="form-control" value="{{$data->do_date->note}}">
                  <button type="submit" class="btn btn-raised btn-default">Send</button>
                {!!Form::close()!!}
            </div>
         </div>
           @endif<!--if do date is alrady-->
           @endif<!--if dont have relation object-->
        </div>
    </div><!--do date end-->
    @endif
            @include('layouts.alert_warning')
               <div class="card">

                    <div><!-- Tab panel -->



          <!--  if user is admin or owner of this clients-->
          @if(Auth::user()->id === $data->user_id or Auth::user()->roles === 'admin')

            <!-- Nav tabs -->
          <div class=" card-heading card-primary">
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active">
                <a href="#task" aria-controls="profile" role="tab" data-toggle="tab">
                <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                  See task</a>
              </li>
              <li role="presentation">
                <a href="#services" aria-controls="home" role="tab" data-toggle="tab">
                <i class="fa fa-briefcase" aria-hidden="true"> </i> Current Services</a>
              </li>
              <li role="presentation">
                <a href="#add" aria-controls="profile" role="tab" data-toggle="tab">
                <i class="fa fa-plus" aria-hidden="true"></i>
                  add services</a>
              </li>
              <li role="presentation">
                <a href="#delete" aria-controls="profile" role="tab" data-toggle="tab">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
                  delete services</a>
              </li>
              <li class="pull-right">
                <a class="btn btn-primary" role="button" data-toggle="collapse" id="collmain" href="#collapseExample"  aria-controls="collapseExample"><i class="fa fa-plus" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Collapse buttom" ></i></a>
              </li>
            </ul>
          </div>
            <!-- Tab panes -->
        <div class="collapse" id="collapseExample">
            <div class="tab-content card-body">
              <div role="tabpanel" class="tab-pane" id="services">  <!-- Tab services -->

                @if($data->services->count() >0 )
                    @foreach($data->services as $dato)
                    <p><i class="fa fa-check-square text-success" aria-hidden="true"></i> {{$dato->service_name}}</p>
                    <hr>
                    @endforeach
                @else

                <p>This client dont have services assigne</p>

                   @endif


              </div>
              <div role="tabpanel" class="tab-pane text-center" id="add"> <!-- Tab add service -->



              @foreach($service as $service)


                 @if(!$data->hasService($service->id))
                 {!! Form::open(['route' => ['client-service',$data->id],'method' => 'post','class'=>'inline-block']) !!}

                      {{ Form::hidden('service', $service->id) }}<p>{{ $service->service_name}}</p>


                   <button class=" btn btn-raised btn-success" type="submit"><i class="fa fa-plus" aria-hidden="true"></i></button>
                  <hr>
                 {!! Form::close() !!}
                 @endif

                    @endforeach

               </div>
               <div role="tabpanel" class="tab-pane text-center" id="delete"> <!-- Tab delete -->


                 @foreach($service->all() as $service)


                @if($data->hasService($service->id))
                    {!! Form::open(['route' => ['client-service-delete',$data->id],'method' => 'post','class'=>'inline-block']) !!}

                         {{ Form::hidden('service', $service->id) }}<p>{{ $service->service_name}}</p>


                      <button class=" btn btn-raised btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                     <hr>
                    {!! Form::close() !!}
                     @endif

                       @endforeach


                </div>
                <div role="tabpanel" class="tab-pane text-center active" id="task"> <!-- Tab task -->

                  <table id="fresh-table" class="table"> <!-- table task-->


                        <thead>
                          <th>avatar</th>
                          <th data-field="ID" data-sortable="true">ID</th>
                          <th data-field="By" data-sortable="true">By</th>
                          <th data-field="Task" data-sortable="true">Task</th>
                            <th data-field="Create At" data-sortable="true">Create At</th>
                          <th data-field="More">More</th>
                        </thead>


                      <tbody>
                         @foreach($task as $data)
                        <tr>
                          <td><img class="circle" src = "/files/avatars/{{$data->avatar}}"> </td>
                          <td><label class="label label-default">{{$data->id}}</label></td>
                         <td><p>{{$data->name}}</p></td>
                         <td><p>{{$data->task_type}}</p></td>
                         <td><i>{{$data->created_at}}</i></td>
                         <td><a class="btn btn-xs btn-raised btn-primary" data-toggle="tooltip" data-placement="top" title="See more" href="{{url('task',$data->id)}}">...</a></td>
                      </tr>
                        @endforeach
                      </tbody>
                  </table>


                 </div>

            </div>
         </div>
          </div>  <!-- Tab panel -->
         </div><!--panen service-->
         @else<!-- else if user is admin or owner of this clients-->

           <div class="card-heading card-warning">

             <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active">
                 <a href="#task" aria-controls="profile" role="tab" data-toggle="tab">
                 <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                   See task</a>
               </li>
               <li role="presentation">
                 <a href="#services" aria-controls="home" role="tab" data-toggle="tab">
                 <i class="fa fa-briefcase" aria-hidden="true"> </i> Services</a>
               </li>
               <li class="pull-right">
                 <a class="btn btn-primary" role="button" data-toggle="collapse" id="collmain" href="#collapseExample"  aria-controls="collapseExample"><i class="fa fa-plus" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Collapse buttom" ></i></a>
               </li>
             </ul>

           </div>
           <div class="collapse" id="collapseExample">
            <div class="tab-content card-body">
              <div role="tabpanel" class="tab-pane" id="services">  <!-- Tab services -->
              @if($data->services->count() >0 )
                  @foreach($data->services as $dato)
                  <p><i class="fa fa-check-square text-success" aria-hidden="true"></i> {{$dato->service_name}}</p>
                  <hr>
                  @endforeach
              @else

                   <p>This client dont have services assigne</p>

                @endif
              </div>
              <div role="tabpanel" class="tab-pane active" id="task">  <!-- Tab task -->
            <table id="fresh-table" class="table"> <!-- table task-->
               <thead>
                    <th>avatar</th>
                    <th data-field="ID" data-sortable="true">ID</th>
                    <th data-field="By" data-sortable="true">By</th>
                    <th data-field="Task" data-sortable="true">Task</th>
                      <th data-field="Create At" data-sortable="true">Create At</th>
                    <th data-field="More">More</th>
                  </thead>
                  <tbody>
                       @foreach($task as $data)
                       <tr>
                         <td><img class="circle" src = "/files/avatars/{{$data->avatar}}"> </td>
                         <td><label class="label label-default">{{$data->id}}</label></td>
                        <td><p>{{$data->name}}</p></td>
                        <td><p>{{$data->task_type}}</p></td>
                        <td><i>{{$data->created_at}}</i></td>
                        <td><a class="btn btn-xs btn-raised btn-primary" data-toggle="tooltip" data-placement="top" title="See more" href="{{url('task',$data->id)}}">...</a></td>
                     </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div>
          </div>
        </div>
         @endif  <!--  if user is admin or owner of this clients-->

       <!--  other feactured for the clients-->
       @if($extra->extra)
       <div class="col-md-4">
         <div class="card">
           <div class="border-card-primary"></div>
           <div class="card-body">

             <p><b>Domain Name:</b> {{$extra->extra->web_url}}</p>
             <div class="divider"></div>
             <p><b>Register At: </b>{{$extra->extra->hosting_info}}</p>
             <p><b>Host Account: </b>{{$extra->extra->hosting_user}}</p>
             <p><b>Host Passwd: </b>{{$extra->extra->hosting_password}}</p>
             <p><b>Call Pin: </b>{{$extra->extra->pin}}</p>
             <p><b>Cp User: </b>{{$extra->extra->Cpanel}}</p>
             <p><b>Cp Passw: </b>{{$extra->extra->Cpanel_password}}</p>
             <p><b>Email: </b>{{$extra->extra->email_one}}</p>
             <p><b>Email two: </b>{{$extra->extra->email_two}}</p>
             <p><b>Email password: </b>{{$extra->extra->email_password}}</p>
           </div>
          <div class="card-footer">
            <br>
             <a class="btn btn-raised btn-xs btn-info" href="{{url('extra/show-edit',$extra->extra->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
             <a class="btn btn-raised btn-xs btn-danger" href="{{url('extra/destroy-domain-name',$extra->extra->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>

          </div>
         </div>
    </div>
    @endif

 @if($extra->bussine)
 <div class="col-md-4">
   <div class="card">
     <div class="border-card-primary"></div>
     <div class="card-body">
         <p><i class="fa fa-globe" aria-hidden="true"></i> Directory Listing</p>
         <div class="divider"></div>
         <p><b>Register at:</b> {{$extra->bussine->login_website}}</p>
         <p><b>Name Listing:</b> {{$extra->bussine->name_listing}}</p>
         <p><b>Email:</b> {{$extra->bussine->login_website}}</p>
          <p><b>Password:</b> {{$extra->bussine->password}}</p>
          <p><b>Subcribed:</b> {{$extra->bussine->sucribed}}</p>
          <p><b>For:</b> {{$extra->bussine->long}}</p>
       @if($extra->bussine->expire == date('Y-m-d'))
          <p><b>Expire Today:</b> <span class="label label-danger">{{$extra->bussine->expire}}</span> </p>
        @else
         <p><b>Expire:</b> {{$extra->bussine->expire}}</p>
      @endif
     </div>
     <div class="card-footer">
       <br>
        <a class="btn btn-raised btn-xs btn-info" href="{{url('extra/show-business-directory',$extra->bussine->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <a class="btn btn-raised btn-xs btn-danger" href="{{url('extra/destroy-business-directory',$extra->bussine->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
     </div>
   </div>
</div>
@endif
@if($extra->external_links)
<div class="col-md-4">
  <div class="card">
    <div class="border-card-primary"></div>
    <div class="card-body">
        <p>
         {{$extra->external_links->login_website}}
       </p>
     <div class="divider"></div>
        <p><b>Email or User:</b> {{$extra->external_links->email}}</p>
          <p><b>Password:</b> {{$extra->external_links->password}}</p>

    </div>
    <div class="card-footer">
      <br>
       <a class="btn btn-raised btn-xs btn-info" href="{{url('extra/show-extra-resource',$extra->external_links->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
       <a class="btn btn-raised btn-xs btn-danger" href="{{url('extra/destroy-extra-resource',$extra->external_links->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
    </div>
  </div>
</div>
@endif
  </div>


    <!--btn float user owner-->

<div class="cont-btn">
  <a class='flotante btn-circle-success botonF1' href='#' ><i class="material-icons">settings</i></a>
  <a class='flotante main-btn botonF2' href="{{url('clients',$data->id)}}" ><i class="material-icons">mode_edit</i></a>
    <a class='flotante main-btn botonF3' href="{{url('task-in-client',$extra->id)}}" ><i class="material-icons">playlist_add</i></a>
</div>
   </div><!--container-->
  </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
@if (notify()->ready())
 alertify.success( '{{ notify()->message() }}' );
@endif

$("#collmain").click(function(){
 if($('#collmain > i').hasClass('fa fa-plus')){
  $('#collmain  i').removeClass('fa fa-plus');
  $('#collmain  i').addClass('fa fa-minus');

}else{
  $('#collmain > i').removeClass('fa fa-minus');
   $('#collmain > i').addClass('fa fa-plus');
}
})
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$('.collapse').collapse({
  toggle: true
})


</script>
@endsection
