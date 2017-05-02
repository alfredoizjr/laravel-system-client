@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

          <div class="card"><!--head panel-->
            <div class="card-body">
               <p><i class="fa fa-thumb-tack" aria-hidden="true"></i> Open Tasks by {{Auth::user()->name}} <a class="btn btn-raised btn-success" href="{{url('close-task')}}"> go to Close tasks <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a></p>
            </div>
          </div><!--head panel-->
             @include('layouts.alert_success')
             @include('layouts.alert_warning')
          <div class="fresh-table toolbar-color-azure">
          <!--    Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
                  Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
          -->
          <div class="toolbar">
              <button  class="btn btn-default">Open</button>
          </div>
          <table id="fresh-table" class="table">
                   <thead>
                      <th data-field="Id" data-sortable="true">Id</th>
                      <th data-field="Type" data-sortable="true">Type</th>
                      <th data-field="Status" data-sortable="true">Status</th>
                      <th data-field="Open at" data-sortable="true">Open at</th>
                      <th data-field="Body" data-sortable="true">Body</th>
                      <th class="text-center"><i class="material-icons">settings</i></th>
                    </thead>
              <tbody>

     @foreach($task as $task)

        <tr>
            <td><span class="label label-default">{{$task->id}}</span></td>
            <td><p>{{$task->task_type}}</p></td>
            <td><p>{{$task->status}}</p></td>
            <td><p>{{$task->created_at->toFormattedDateString()}}</p></td>
            @if($task->archives()->count() > 0)
            <td><p>{{strip_tags($task->curtString($task->task_body))}} <i class="fa fa-paperclip" aria-hidden="true"></i></p></td>
           @else
               <td><p>{{strip_tags($task->curtString($task->task_body))}}</p></td>
           @endif
            <td>
              <a title="see detail" class="btn btn-raised btn-primary btn-xs" href="{{route('task.show',$task->id)}}"><i class="fa fa-eye fa-1x" aria-hidden="true"></i></a>
              <a title="edit task" class="btn btn-raised btn-default btn-xs" href="{{route('task.edit',$task->id)}}"><i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i></a>
              <a  title="close task" class="btn btn-raised btn-warning btn-xs" href="{{url('close-task',$task->id)}}"><i class="fa fa-exclamation fa-1x" aria-hidden="true"></i></a>
              <a title="delete task" class="btn btn-raised btn-danger btn-xs" href="" data-toggle="modal" data-target="#myModal"><i class="fa fa-trash-o fa-1x" aria-hidden="true"></i></a>
            </td>

      </tr>
      <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
 <div class="modal-content">
   <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
     <h4 class="modal-title" id="myModalLabel">Modal title</h4>
   </div>
   <div class="modal-body">
     <h5><i class="fa fa-exclamation fa-3x" aria-hidden="true"></i> Warning</h5>
     <p>
       If you delete this task you will not be able to recover it in the future!
     </p>
   </div>
   <div class="modal-footer">
     <a id="fix-btn-modal" class=" btn btn-raised btn-danger" data-dismiss="modal">cancel</a>
     <a class="btn btn-raised btn-primary" href="{{url('delete-task',$task->id)}}">Delete</a>
   </div>
 </div>
</div>
</div>
    @endforeach
   </table>
   <!--table list clients-->
   </div>
</div>
</div>
<!--btn float user owner-->

<div class="cont-btn">
<a class='flotante btn-circle-success botonF1' href='#' ><i class="material-icons">settings</i></a>
<a class='flotante main-btn botonF2' href="{{url('task/create')}}" ><i class="material-icons">playlist_add</i></a>
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
