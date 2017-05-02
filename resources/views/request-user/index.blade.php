@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

      <div class="card"><!--head panel-->
        <div class="card-body">
           <p><i class="fa fa-bullhorn" aria-hidden="true"></i> Request For you</p>
        </div>
      </div><!--head panel-->
      <div class="col-md-12">
        <div class="pull-right">
          {{$request->links()}}
        </div>
     </div>
    @foreach($request as $request)
    <div class="col-md-6">

   <div class="card">
     <div class="border-card-primary"></div>
     <div class="sub-card-heading">

        <p><b>Do date:</b> <i>{{date('F j, Y',strtotime($request->do_date))}}</i></p>
        <p><b>request date:</b> <i>{{$request->created_at->toFormattedDateString()}}</i></p>

     </div>
     <div class="card-body">

       <br>
        <a title="see more" class="btn btn-raised btn-sm" href="{{url('request-user',$request->id)}}"><h5>{{$request->title}}</h5></a>
       <div class="divider">

       </div>
       <p>{!!$request->curtString($request->body)!!}</p>
       <div class="card-footer">
         <p>
           By <b>{{$request->owner}} </b> / status <span class="label label-primary">{{$request->status}}</span>
         </p>
       </div>
     </div>
   </div>
 </div>

    @endforeach

</div>
</div>

@endsection
