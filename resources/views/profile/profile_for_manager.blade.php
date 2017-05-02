
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
<div class="card"><!--head panel-->
  <div class="card-body">
     <p><i class="fa fa-smile-o" aria-hidden="true"></i> {{$data->name}}'s profile  <a class="btn btn-raised btn-info" href="{{url('user')}}"><i class="fa fa-user-circle" aria-hidden="true"></i> Users list </a></p>
  </div>
</div><!--head panel-->
<div class="col-md-9"><!-- Nav tabs -->
  <div class="card">
    <div class="card-heading card-primary">
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#OpenTask" aria-controls="home" role="tab" data-toggle="tab">Open task <span class="label label-default">{{$open}}</span></a></li>
        <li role="presentation"><a href="#CloseTask" aria-controls="profile" role="tab" data-toggle="tab">Close Task <span class="label label-default">{{$close}}</span></a></li>
     </ul>
    </div><!-- Nav tabs -->
    <div class="card-body">
      <div class="tab-content"><!-- Tab panes -->
         <div role="tabpanel" class="tab-pane active" id="OpenTask">

           <table id="fresh-table" class="table">
               <thead>

                   <th data-field="id" data-sortable="true">Id</th>
                   <th data-field="Type" data-sortable="true">Type</th>
                  <th data-field="create" data-sortable="true">create</th>
                   <th data-field="Body" data-sortable="true">Body</th>
                   <th data-field="status" data-sortable="false">status</th>
                   <th class="text-center" data-field="action" data-sortable="false">action</th>
                 </thead>
        <tbody>
          @foreach($data->tasks as $task)
          @if($task->status != 'close')
          <tr>
            <td><p>{{$task->id}}</p></td>
            <td><p>{{$task->task_type}}</p></td>
            <td><p>{{$task->created_at->toFormattedDateString()}}</p></td>
            <td><p>{{strip_tags($task->curtString($task->task_body))}}</p></td>
              <td><span class="label label-info">{{$task->status}}</span></td>
               <td class="text-center"><a title="see detail" class="btn btn-raised btn-primary btn-xs" href="{{route('task.show',$task->id)}}"><i class="fa fa-eye fa-1x" aria-hidden="true"></i></a></td>
          </tr>
          @endif
            @endforeach
      </table>
      <!--table list open-->


         </div>
        <div role="tabpanel" class="tab-pane" id="CloseTask"><!--table list close-->
          <table id="fresh-table" class="table">
             <thead>
                  <th data-field="id" data-sortable="true">Id</th>
                  <th data-field="Type" data-sortable="true">Type</th>
                  <th data-field="create" data-sortable="true">create</th>
                  <th data-field="close" data-sortable="true">close</th>
                  <th data-field="Body" data-sortable="true">Body</th>
                  <th data-field="status" data-sortable="false">status</th>
                  <th class="text-center" data-field="action" data-sortable="false">action</th>
                </thead>
       <tbody>
         @foreach($data->tasks as $task)
         @if($task->status != 'open')
         <tr>
           <td><p>{{$task->id}}</p></td>
           <td><p>{{$task->task_type}}</p></td>
           <td><p>{{$task->created_at->toFormattedDateString()}}</p></td>
           <td><p>{{$task->updated_at->toFormattedDateString()}}</p></td>
           <td><p>{{strip_tags($task->curtString($task->task_body))}}</p></td>
           <td><span class="label label-success">{{$task->status}}</span></td>
           <td class="text-center"><a title="see detail" class="btn btn-raised btn-primary btn-xs" href="{{route('task.show',$task->id)}}"><i class="fa fa-eye fa-1x" aria-hidden="true"></i></a></td>
         </tr>
         @endif
           @endforeach
     </table>
     <!--table list open-->
</div><!--table list close-->

    </div><!-- Tab panes -->
  </div><!-- card body -->
  </div><!-- card  -->
</div>
<div class="col-md-3">
  <div class="card">
    <div class="border-card-primary"></div>
    <div class="card-body">

        <a  href="" class="thumbnail ">
            <img src="/files/avatars/{{$data->avatar}}" alt="...">
        </a>


      <p>clients was insert for this user</p>
     @foreach($data->clients as $clients)
      <p><a href="{{url('folder',$clients->id)}}">{{$clients->business_name}} \<b> <i class="fa fa-clock-o" aria-hidden="true"></i> {{$clients->created_at}}</b></a></p>
      <div class="divider"></div>
     @endforeach
  </div>
  </div>
</div>
</div>
</div>
@endsection
