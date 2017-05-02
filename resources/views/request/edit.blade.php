@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
@include('layouts.errors')

<div class="card">
  <div class="card-body">
    {!!Form::model($request,['route' => ['request.update', $request->id],'method'=>'PUT','files'=>true])!!}
      {{ csrf_field() }}
    <div class="col-md-12">
      <div class="form-group">
            <input name="title" type="text" class="form-control" id="exampleInputEmail1" value="{{$request->title}}" placeholder="title">
       </div>
    </div>
    <div class="col-md-6">
      <div class="input-group">
        <input type="text" id="fecha" name="do_date" class="form-control" value="{{$request->do_date}}"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
     </div>
    </div>
    <div class="form-group col-md-6">
<label for="inputFile" class="col-md-2 control-label">File</label>

<div class="col-md-10">
 <input type="text" readonly="" class="form-control" placeholder="Click for add archive...">
 <input type="file" id="inputFile" name="archive">
</div>
</div>
    <div class="col-md-12">
          {{Form::textarea('body',$request->body,['class' => 'ckeditor'])}}
    </div>
        {{Form::hidden('user_id',$request->user_id)}}
        {{Form::hidden('owner',$request->owner)}}
        <div class="pull-right">
          <a class="btn btn-raised btn-info" href="{{url('request')}}">Back to the list</a>
          <a class="btn btn-raised btn-danger" href="{{url('request',$request->id)}}">See Request</a>
            <button type="submit" class="btn btn-raised btn-primary" name="button">Edit</button>
        </div>
     </div>

  {!!Form::close()!!}
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
