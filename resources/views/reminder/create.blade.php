@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">


          <div class="card"><!--head panel-->
            <div class="card-body">
               <p><i class="fa fa-address-card-o" aria-hidden="true"></i> Your reminders</p>
            </div>
          </div><!--head panel-->
          <div class="container">
              <div class="row">
          <div class="col-md-10 col-md-offset-1">
             @include('layouts.errors')
          <div class="card">
            <div class="card-body">
              <form class="" action="{{route('reminder.store')}}" method="post">
                {{ csrf_field() }}
              <div class="form-group">
                    <input name="title" type="text" class="form-control" id="exampleInputEmail1" value="{{$data->title}}" placeholder="title">
               </div>
               <div class="form-group">
                     <textarea name="body" class="ckeditor" rows="3" value="{{$data->body}}" placeholder="Text..."></textarea>
                </div>
                <div class="input-group date col-md-4">
                  <input type="text" id="fecha" name="expire" class="form-control" value="{{$data->expire}}"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
               </div>
               <input name="user_id" type="hidden"  value="{{Auth::user()->id}}" >
                  <div class="pull-right">
                    <a class="btn btn-raised btn-danger" href="{{url('reminder')}}">Cancel</a>
                      <button type="submit" class="btn btn-raised btn-primary" name="button">Make it</button>
                  </div>
               </div>
            </form>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('script')
<script type="text/javascript">
@if (notify()->ready())

alertify.success( '{{ notify()->message() }}' );

@endif
$("#cke_47").hide();
</script>

@endsection
