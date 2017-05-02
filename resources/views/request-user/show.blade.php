@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

      <div class="card"><!--head panel-->
        <div class="card-body">
           <p><i class="fa fa-bullhorn" aria-hidden="true"></i> Request detail <a class="btn btn-raised btn-info" href="{{url('request-user')}}">Back to the list</a></p>
        </div>
      </div><!--head panel-->

<div class="card">
  <div class="sub-card-heading">
    <p>
     <b>Do date</b> {{$data->do_date}}
    </p>
  </div>
  <div class="card-body">
    <h5>{{$data->title}}</h5>
    <br>
      {!!$data->body!!}
      <br>
        <div class="row">
      @foreach($data->archives as $img)

         @if($img->ext_archive === "jpg" or $img->ext_archive === "png")

         <ul class="list-w-img">
           <li>
             <div class="col-md-6">
                 <a href="{{url('files/request',$img->name_archive)}}" data-lightbox="image-1" data-title="{{$img->name_archive}}" ><img class=" thumbnail responsive-img" src="/files/request/{{$img->name_archive}}" alt="" /></a>
             </div>


         </li>
         </ul>
      @endif

       @endforeach
 </div>
    <div class="divider"></div>
    <br>
    <div class="row">
    @foreach($data->archives as $archives)
    @if($archives->ext_archive === "jpg" or $archives->ext_archive === "png")
    <div class="col-md-6">
          <a  class="link" download="" href="{{url('files/archives',$archives->name_archive)}}"><i class="fa fa-picture-o fa-2x" aria-hidden="true"></i> {{$archives->original}}</a>

      </div>

    @endif
    @if($archives->ext_archive === "docx" or $archives->ext_archive === "doc")
    <div class="col-md-6">
          <a  class="link" download="" href="{{url('files/archives',$archives->name_archive)}}"><i class="fa fa-file-word-o fa-2x" aria-hidden="true"></i> {{$archives->original}}</a>

      </div>

    @endif
    @if($archives->ext_archive === "xlsx" or $archives->ext_archive === "xls")
    <div class="col-md-6">
          <a  class="link" download="" href="{{url('files/archives',$archives->name_archive)}}"><i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i> {{$archives->original}}</a>

      </div>

    @endif
    @if($archives->ext_archive === "pdf")
    <div class="col-md-6">
          <a  class="link" download="" href="{{url('files/archives',$archives->name_archive)}}"><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i> {{$archives->original}}</a>
      </div>

    @endif
 @endforeach
  </div>


  </div>
</div>



</div>
</div>

@endsection
