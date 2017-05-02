@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
@include('layouts.errors')

<div class="card">
  <div class="card-body">
    <form class="" action="{{route('request.store')}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
    <div class="col-md-12">
      <div class="form-group">
            <input name="title" type="text" class="form-control" id="exampleInputEmail1" value="{{$request->title}}" placeholder="title">
       </div>
    </div>
    <div class="col-md-4">
      <select name="user_id" class="form-control">
        @foreach($user as $user)
         @if(Auth::user()->id != $user->id )
           <option  value="{{$user->id}}" >{{$user->name}} </option>
         @endif
       @endforeach
     </select>
    </div>
    <div class="col-md-4">
      <div class="input-group">
        <input type="text" id="fecha" name="do_date" class="form-control" value="{{$request->do_date}}"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
     </div>
    </div>
    <div class="form-group col-md-4">
<label for="inputFile" class="col-md-2 control-label">File</label>

<div class="col-md-10">
 <input type="text" readonly="" class="form-control" placeholder="Click for add archive...">
 <input type="file" id="inputFile" name="archive">
</div>
</div>
    <div class="col-md-12">
      <textarea name="body" class="ckeditor" rows="3" placeholder="max 200 character Your text..."></textarea>
    </div>
        <input type="hidden"  name="owner" value="{{Auth::user()->name}}">
        <div class="pull-right">
          <a class="btn btn-raised btn-danger" href="{{url('request')}}">Cancel</a>
            <button type="submit" class="btn btn-raised btn-primary" name="button">Make it</button>
        </div>
     </div>
  </form>
  </div>
</div>


</div>
</div>

@endsection
