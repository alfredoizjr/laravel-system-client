@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <br>
        <div class="col-md-10 col-md-offset-1">

         <div class="card">
             <div class="card-heading card-warning"><p><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i> Edit</p></div>

             <div class="card-body">


             {!!Form::model($task,['route' => ['task.update', $task->id],'method'=>'PUT','files'=>true])!!}
              <div class="form-group col-md-6">
                {{Form::text('task_type',$task->task_type,['class' => 'form-control'])}}
              </div>
              <div class="form-group col-md-6">
         <label for="inputFile" class="col-md-2 control-label">File</label>

         <div class="col-md-10">
           <input type="text" readonly="" class="form-control" placeholder="Browse...">
           <input type="file" id="inputFile" name="archive">
         </div>
       </div>
              <div class="form-group col-md-12">
                {{Form::textarea('task_body',$task->task_body,['class' => 'ckeditor','placeholder'=>'Business Phone'])}}
              </div>

             <div class="form-group">
                {{Form::hidden('status','open')}}
                {{Form::hidden('user_id',$task->user_id)}}
                {{Form::hidden('client_id',$client)}}
                {{Form::hidden('id',$task->id)}}

          </div>
              <div class="pull-right">
                <a class='btn btn-raised btn-info' href="{{url('/task')}}">back to the tasks</a>
                <a class='btn btn-raised btn-warning' href="{{url('/task',$task->id)}}">see this task</a>
                {{Form::submit('Edit',['class'=>'btn btn-raised btn-success'])}}
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
@if (notify()->type() === "success")

alertify.success( '{{ notify()->message() }}' );
@endif

</script>

@endsection
