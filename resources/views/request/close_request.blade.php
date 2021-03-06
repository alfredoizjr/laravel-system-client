@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="card"><!--head panel-->
        <div class="card-body">
           <p><i class="fa fa-rocket" aria-hidden="true"></i> My request</p>
        </div>
      </div><!--head panel-->
      <div class="btn-group btn-group-justified btn-group-raised">
  <a href="{{url('request')}}" class="btn">Open</a>
  <a href="{{url('request-close')}}" class="btn active">close</a>
</div>
      @include('layouts.alert_success')
      <div class="fresh-table toolbar-color-green">
      <!--    Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
              Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
      -->

          <div class="toolbar">
              <button  class="btn btn-default">Your request close</button>
          </div>

          <table id="fresh-table" class="table">
           <thead>
                <th data-field="id" data-sortable="true">id</th>
                <th data-field="Title" data-sortable="true">Title</th>
                 <th data-field="Body" data-sortable="true">Body</th>
                 <th data-field="Creation" data-sortable="true">Creation</th>
                  <th data-field="Do Date" data-sortable="true">Do Date</th>
                  <th data-field="To" data-sortable="true">To</th>
                  <th data-field="Status" data-sortable="true">Status</th>
                  <th class="text-center"><i class="fa fa-cog" aria-hidden="true"></i></th>
          </thead>
          <tbody>
                 @foreach($close as $close)
                <tr>
                  <td><span class="label label-default" >{{$close->id}}</span></td>
                  <td><a title="See this profile" href="{{url('request-close',$close->user->id)}}">{{$close->title}}</a></td>
                  <td><a title="See this profile" href="{{url('request-close',$close->user->id)}}">{{strip_tags($close->curtString($close->body))}}</a></td>
                  <td>{{$close->created_at->toFormattedDateString()}}</td>
                  <td>{{$close->do_date}}</td>
                  <td><a title="See this profile" href="{{url('profile',$close->user->id)}}"><i class="fa fa-user" aria-hidden="true"></i>{{$close->user->name}}</a></td>
                  <td> <span class="label label-success">{{$close->status}}</span></td>
                  <td>
                    <a title="Reopen this request" class="btn btn-raised btn-xs btn-info" href="{{url('request/reopen',$close->id)}}"><i class="fa fa-circle-o" aria-hidden="true"></i></a>
                    <a title="see detail" class="btn btn-raised btn-primary btn-xs" href="{{url('request',$close->id)}}"><i class="fa fa-eye fa-1x" aria-hidden="true"></i></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
          </table>
      </div>
    </div>
    <!--btn float user owner-->

    <div class="cont-btn">
    <a class='flotante btn-circle-success botonF1' href='#' ><i class="material-icons">settings</i></a>
    <a class='flotante main-btn botonF2' href="{{route('request.create')}}" ><i class="material-icons">note_add</i></a>
    </div>
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
