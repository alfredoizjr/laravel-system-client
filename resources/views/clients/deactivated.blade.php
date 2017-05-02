@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
    <!--btn-->
@include('layouts.btn_group')
<!--btn-->

@if (session('success'))
<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong><i class="fa fa-check" aria-hidden="true"></i> Well done! </strong> {{session('success')}}
</div>
@endif
<!--panel with table-->

  <!--table list clients-->
  <div class="fresh-table toolbar-color-red">
  <!--    Available colors for the full background: full-color-blue, full-color-azure, full-color-green, full-color-red, full-color-orange
          Available colors only for the toolbar: toolbar-color-blue, toolbar-color-azure, toolbar-color-green, toolbar-color-red, toolbar-color-orange
  -->

      <div class="toolbar">
          <button  class="btn btn-default">Deactivated</button>
      </div>

      <table id="fresh-table" class="table">


            <thead>

              <th data-field="name" data-sortable="true">Name</th>
              <th data-field="salary" data-sortable="true">Account</th>
              <th data-field="country" data-sortable="true">Email</th>
              <th data-field="city">Phone</th>
              <th data-field="id">Date Creation</th>
              <th>Folder</th>
              <th class=" text-center">Actions</th>
            </thead>
   <tbody>
     @foreach($data as $data)
     <tr>
       <td>{{$data->business_name}}</td>
       <td>{{$data->business_account}}</td>
       <td>{{$data->business_email}}</td>
        <td>{{'('.substr($data->business_phone, 0, 3).') '.substr($data->business_phone, 3, 3).' '.substr($data->business_phone, 6, 4)}}</td>
       <td>{{$data->created_at->toFormattedDateString()}}</td>
       <td> <a class="btn btn-raised btn-xs" href="{{url('folder',$data->id)}}"> <i class="fa fa-folder" aria-hidden="true"></i></a></td>
       <td class="text-center">
          <a class="btn btn-raised btn-default btn-xs" href="{{url('clients',$data->id)}}"><i class="fa fa-pencil-square-o fa-1x" aria-hidden="true"></i>
         <a class="btn btn-raised btn-info btn-xs" href="{{url('statusa',$data->id)}}"><i class="fa fa-bell-o fa-1x" aria-hidden="true"></i></a>
         <a class="btn btn-raised btn-warning btn-xs" href="{{url('statusp',$data->id)}}"><i class="fa fa-hand-paper-o fa-1x" aria-hidden="true"></i>
         </a>
       </td>
     </tr>
       @endforeach
 </table>
 <!--table list clients-->



        </div><!--col-->
    </div>
    <div class="cont-btn">
    <a class='flotante btn-circle-success botonF1' href='#' ><i class="material-icons">settings</i></a>
    <a class='flotante main-btn botonF2' href="{{route('clients.create')}}" ><i class="material-icons">group_add</i></a>
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
