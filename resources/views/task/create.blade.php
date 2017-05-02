@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
     <div class="col-md-10 col-md-offset-1">
       <br>
       <div class="card">
           <div class="card-heading card-warning"><p><i class="fa fa-plus fa-2x" aria-hidden="true"></i> Insert a new task</p></div>
          @include('layouts.errors')
           <div class="card-body">
      {!!Form::open(['url' => 'task', 'method' => 'POST','files'=>true])!!}
       <div class="form-group col-md-12">
         @if($service->all()->count()> 0)
         <select class="form-control col-md-12" name="task_type">
         @foreach($service->all() as $service)
          <option value="{{$service->service_name}}" >{{$service->service_name}}</option>
       @endforeach()
       </select>
       @else
       <div class="form-group col-md-12">
         {{Form::text('task_type','',['class' => 'form-control','placeholder'=>'Type task...'])}}
       </div>
       @endif
       </div>

       <div class="form-group col-md-6">
         <select class="form-control" name="client_id">
        @foreach($client->all() as $client)
         <option value="{{$client->id}}" >{{$client->business_name}}</option>
        @endforeach()
      </select>
       </div>
       <div class="form-group col-md-6">
  <label for="inputFile" class="col-md-2 control-label">File</label>

  <div class="col-md-10">
    <input type="text" readonly="" class="form-control" placeholder="Browse...">
    <input type="file" id="inputFile" name="archive">
  </div>
</div>
       <div class="form-group col-md-12">
         {{Form::textarea('task_body',$task->task_body,['class' => 'ckeditor','placeholder'=>'Body of the task...'])}}
       </div>
       <div class="form-group col-md-12">
         {{Form::hidden('status','open')}}
         {{Form::hidden('user_id',Auth::user()->id)}}
         {{Form::hidden('create',null)}}
       </div>
       <div class="pull-right">
         <a class='btn btn-raised btn-warning' href="{{url('task')}}">Cancel</a>

         {{Form::submit('Send',['class'=>'btn btn-raised btn-success'])}}

       </div>
      {!!Form::close()!!}
    </div>
  </div>
    </div>
    </div>

</div>

@endsection
