@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="card"><!--head panel-->
        @if(Auth::user()->roles === 'admin')
        <div class="card-body">
           <p>
              <a class="btn btn-raised btn-info" href="{{url('task')}}"><i class="fa fa-thumb-tack" aria-hidden="true"></i> Back to the tasks</a>
           </p>
        </div>
        @else
        <div class="card-body">
           <p><a class="btn btn-raised btn-info" href="{{url('task')}}"><i class="fa fa-thumb-tack" aria-hidden="true"></i> Back to the tasks</a></p>
        </div>
        @endif
      </div><!--head panel-->
      @include('layouts.alert_success')
      @include('layouts.alert_warning')
         <div class="col-md-8">
           <div class="card">
             <div class="border-card-primary"></div>
             <div class="card-body">
                 <h2>{!!$data->task_type!!}</h2>
                 <p class="pull-right this-p">
                   <a title="add archives" class="btn btn-raised btn-xs btn-primary" class="btn btn-primary" data-toggle="modal" data-target="#myModal" href="#"><i class="fa fa-paperclip fa-2x" aria-hidden="true"></i></a>
                 </p>
                 <br>
                 <p>
                   {!!$data->task_body!!}
                 </p>
          @if($data->archives->count()>0)
            <br>
          <div class="row">
           @foreach($data->archives as $img)

              @if($img->ext_archive === "jpg" or $img->ext_archive === "png")

              <ul class="list-w-img">
                <li>
                  <div class="col-md-6">
                      <a href="{{url('files/archives',$img->name_archive)}}" data-lightbox="image-1" data-title="My caption" ><img class=" thumbnail responsive-img" src="/files/archives/{{$img->name_archive}}" alt="" /></a>
                  </div>


              </li>
              </ul>
           @endif

            @endforeach
            </div>
               <br>

                 <div class="divider"> </div>
                 <div class="row">
                 @foreach($data->archives as $archives)
                 @if($archives->ext_archive === "jpg" or $archives->ext_archive === "png")
                 <div class="col-md-6">
                       <a  class="link" download="" href="{{url('files/archives',$archives->name_archive)}}"><i class="fa fa-picture-o fa-2x" aria-hidden="true"></i> {{$archives->original}}</a>
                       -//- <a class="btn btn-raised btn-xs" href="{{url('archive/delete',$archives->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                   </div>

                 @endif
                 @if($archives->ext_archive === "docx" or $archives->ext_archive === "doc")
                 <div class="col-md-6">
                       <a  class="link" download="" href="{{url('files/archives',$archives->name_archive)}}"><i class="fa fa-file-word-o fa-2x" aria-hidden="true"></i> {{$archives->original}}</a>
                      -//- <a class="btn btn-raised btn-xs" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>
                   </div>

                 @endif
                 @if($archives->ext_archive === "xlsx" or $archives->ext_archive === "xls")
                 <div class="col-md-6">
                       <a  class="link" download="" href="{{url('files/archives',$archives->name_archive)}}"><i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i> {{$archives->original}}</a>
                       -//- <a class="btn btn-raised btn-xs" href="{{url('archive/delete',$archives->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                   </div>

                 @endif
                 @if($archives->ext_archive === "pdf")
                 <div class="col-md-6">
                       <a  class="link" download="" href="{{url('files/archives',$archives->name_archive)}}"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i> {{$archives->original}}</a>
                       -//- <a class="btn btn-raised btn-xs" href="{{url('archive/delete',$archives->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                   </div>

                 @endif
              @endforeach
               </div>
              @endif
             </div>
             <div class="card-footer">

               <p>
                 <b>On the </b> {{$data->client->business_name}} | <span class="label label-info">{{$data->status}}</span>
               </p>

             </div>
           </div>
         </div>
         <div class="col-md-4">
           <div class="card">
             <div class="border-card-primary"></div>
             <div class="card-body">

               <div class="list-group">
                <div class="list-group-item">
                      <div class="row-picture">
                        <a href="{{url('profile',$data->user->id)}}"> <img class="circle" src="/files/avatars/{{$data->user->avatar}}" alt="icon"></a>
                      </div>
                       <div class="row-content">
                        <h4 class="list-group-item-heading">By {{$data->user->name}}</h4>
                       <p class="list-group-item-text">Tasks created by this user  <span class="label label-primary">{{$data->user->tasks->count()}}</span></p>
                    </div>
                 </div>
             </div>

           </div>
         </div>
           <div class="card">
             <div class="border-card-primary"></div>
             <div class="text-center card-body">

                @if($data->status === 'open')
                <p>
                  actions for this task
                </p>
                <a title="edit task" class="btn btn-raised btn-default btn-xs" href="{{route('task.edit',$data->id)}}"><i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i></a>
                <a title="close task" class="btn btn-raised btn-warning btn-xs" href="{{url('close-task',$data->id)}}"><i class="fa fa-exclamation fa-1x" aria-hidden="true"></i></a>
               <a title="add archives" class="btn btn-raised btn-xs btn-danger" class="btn btn-primary" data-toggle="modal" data-target="#del" href="#"><i class="fa fa-trash" aria-hidden="true"></i></a>
               @else
                 <p class="text-center">
                   History for this task
                 </p>
                 <p class="text-center">
                   Open <b>{{$data->created_at}}</b>
                 </p class="text-center">
                 <p>
                   Close <b>{{$data->updated_at}}</b>
                 </p>
                 <p>spending hours <span class="label label-info">{{$data->getHr($data->created_at,$data->updated_at)}}</span></p>
               @endif
             </div>

           </div>
           <!-- Modal -->
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="myModalLabel">Modal title</h4>
       </div>
       <div class="modal-body">
          {!!Form::open(['url' => 'add/archive', 'method' => 'POST','files'=>true])!!}
       </div>
       <div class="form-group col-md-12">

  <div class="col-md-10">
    <input type="text" readonly="" class="form-control" placeholder="Click here for add...">
    <input type="file" id="inputFile" name="archive">
  </div>
</div>
      {{Form::hidden('task_id',$data->id)}}
       <div class="modal-footer">
         <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-raised btn-primary">add</button>
       </div>
       {!!Form::close()!!}
     </div>
   </div>
 </div>
 <!-- Modal dlete -->
<div class="modal fade" id="del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
<a class="btn btn-raised btn-primary" href="{{url('delete-task',$data->id)}}">Delete</a>
</div>
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
@if(notify()->type() === "warning")
alertify.error( '{{ notify()->message() }}' );
@endif
</script>

@endsection
