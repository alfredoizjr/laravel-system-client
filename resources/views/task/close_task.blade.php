@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

          <div class="card"><!--head panel-->
            <div class="card-body">
               <p><i class="fa fa-thumb-tack" aria-hidden="true"></i> Close Tasks by {{Auth::user()->name}}  <a class="btn btn-raised btn-info" href="{{url('task')}}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> back to Open tasks</a></p>
            </div>
          </div><!--head panel-->
             @include('layouts.alert_success')
          <div class="fresh-table toolbar-color-green">
          <!--    Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
                  Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
          -->
          <div class="toolbar">
              <button  class="btn btn-default">Close</button>
          </div>
        <table id="fresh-table" class="table">
                <thead>
                      <th data-field="Id" data-sortable="true">Id</th>
                      <th data-field="Type" data-sortable="true">Type</th>
                      <th data-field="Status" data-sortable="true">Status</th>
                      <th data-field="Open at" data-sortable="true">Open at</th>
                      <th data-field="Close at" data-sortable="true">Close at</th>
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
            <td><p>{{$task->updated_at->toFormattedDateString()}}</p></td>
            @if($task->archives()->count() > 0)
            <td><p>{{strip_tags($task->curtString($task->task_body))}} <i class="fa fa-paperclip" aria-hidden="true"></i></p></td>
           @else
               <td><p>{{strip_tags($task->curtString($task->task_body))}}</p></td>
           @endif
            <td>
              <a title="see detail" class="btn btn-raised btn-primary btn-xs" href="{{route('task.show',$task->id)}}"><i class="fa fa-eye fa-1x" aria-hidden="true"></i></a>
              <a onclick="del()" title="delete task" class="btn btn-raised btn-danger btn-xs" href="#"><i class="fa fa-trash-o fa-1x" aria-hidden="true"></i></a>
            </td>

      </tr>
      <script type="text/javascript">
     function del() {
         swal({
               title: "Are you sure?",
                text: "You will not be able to recover this task for the future!",
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

                     location.href = "{{url('delete-task',$task->id)}}"

                   } else {
                     swal("Cancelled", "the request was cancelled", "error");
                   }
                   });
      }
  </script>


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
