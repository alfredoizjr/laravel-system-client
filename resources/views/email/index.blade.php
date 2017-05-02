@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

          <div class="card"><!--head panel-->
            <div class="card-body">
               <p><i class="fa fa-envelope-o" aria-hidden="true"></i> Send Email</p>
            </div>
          </div><!--head panel-->
          @include('layouts.alert_success')
          <div class="col-md-3">

  <table class="table table-striped table-hover ">
 <thead>
   <tr>
     <th>#</th>
     <th>My contact</th>
   </tr>
 </thead>
 <tbody>
   @foreach($contacts as $contact)
   <tr>
     <td> {{$contact->id}}</td>
     <td> <a href="#"   class="email">{{$contact->email}}</a></td>
   </tr>
   @endforeach
 </tbody>
</table>
          </div>
          <div class="col-md-9">

         <div class="card">
           <div class="card-body">

           {!!Form::open(['url' => 'send', 'method' => 'POST'])!!}
            <div class="form-group">
              {{Form::text('title','',['class' => 'form-control','placeholder'=>'title'])}}
            </div>
            @if(isset($data))
            <div class="form-group">
              {{Form::email('to',$data,['class' => 'form-control search','placeholder'=>'to','required'])}}
            </div>
            @else
            <div class="form-group">
              <input type="text" name="to" class="search form-control" value="">
            </div>
            @endif
            <div class="form-group">
              {{Form::textarea('content','',['class' => 'form-control','placeholder'=>'Body'])}}
            </div>

            <div class="pull-right">

              {{Form::submit('Send',['class'=>'btn btn-raised btn-success'])}}
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
$( document ).ready(function() {

  $(".email").click(function(){

    var a = $(this).html();
      $(".search").attr("value", a)
  });


});


</script>

@endsection
