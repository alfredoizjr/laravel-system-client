@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

          <div class="card"><!--head panel-->
            <div class="card-body">
               <p><i class="fa fa-address-card-o" aria-hidden="true"></i> Your reminders</p>
            </div>
          </div><!--head panel-->
          <div class="pull-right">
            {{ $data->links() }}
          </div>
          <div class="card">
            <div class="card-body">
              @if($data->count() > 0)
              @foreach($data as $data)
              <br>
                <h5 style="text-decoration:underline;">{{$data->title}}</h5>
                <p>
                  <br>
                  {!!$data->body!!}
                </p>
                <div class="divider">

                </div>
                <div class="card-footer">
                  <br>
                  <a class="btn links" title="edit" href="{{route('reminder.edit',$data->id)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                  <a class="btn links" title="delete it" href="{{url('reminder/delete',$data->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </div>
              @endforeach
              @else
              <div class="text-center">
                <h2><i class="fa fa-address-card-o" aria-hidden="true"></i> You dont have any Reminder yet !!</h2>
                <a class="btn btn-rised btn-raised btn-success" href="{{route('reminder.create')}}">Create Here !</a>
              </div>

              @endif
            </div>
          </div>
          <div class="cont-btn">
          <a class='flotante btn-circle-success botonF1' href='#' ><i class="material-icons">settings</i></a>
          <a class='flotante main-btn botonF2' href="{{route('reminder.create')}}" ><i class="material-icons">note_add</i></a>
          </div>

@endsection
@section('script')
<script type="text/javascript">
@if (notify()->ready())

alertify.success( '{{ notify()->message() }}' );

@endif
@if(notify()->ready() and notify()->type() != 'success')

alertify.log( '{{ notify()->message() }}' );

@endif
</script>

@endsection
