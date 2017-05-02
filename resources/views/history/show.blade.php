@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

          <div class="card"><!--head panel-->
            <div class="card-body">
               <p><i class="fa fa-newspaper-o" aria-hidden="true"></i> History <a class="btn btn-raised btn-info" href="{{url('folder',$back)}}"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Go Back</a></p>
            </div>
          </div><!--head panel-->
          <script type="text/javascript">
          (function(document) {
         'use strict';

         var LightTableFilter = (function(Arr) {

           var _input;

           function _onInputEvent(e) {
             _input = e.target;
             var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
             Arr.forEach.call(tables, function(table) {
               Arr.forEach.call(table.tBodies, function(tbody) {
                 Arr.forEach.call(tbody.rows, _filter);
               });
             });
           }

           function _filter(row) {
             var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
             row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
           }

           return {
             init: function() {
               var inputs = document.getElementsByClassName('light-table-filter');
               Arr.forEach.call(inputs, function(input) {
                 input.oninput = _onInputEvent;
               });
             }
           };
         })(Array.prototype);

         document.addEventListener('readystatechange', function() {
           if (document.readyState === 'complete') {
             LightTableFilter.init();
           }
         });

         })(document);
          </script>

          <div class="col-md-5">
            <div class="input-group">
              <div  class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div>
               <input id="search"  type="text" class="light-table-filter form-control input-lg" name="search" data-table="order-table" placeholder="Search...">
            </div>
          </div>

     <div class="col-md-12">
       <table class="order-table table table-striped table-hover ">
       <thead>

         <tr>
           <th>User</th>
           <th>Description</th>
           <th>Date</th>
           <th>accion</th>
         </tr>
       </thead>
       <tbody>
      @foreach($data as $datas)
         <tr>
           <td>{{$datas->user}}</td>
           <td>{{$datas->description}}</td>
           <td>{{$datas->created_at}}</td>
           <td>{{$datas->accion}}</td>
         </tr>
      @endforeach
       </tbody>
     </table>
     </div>

  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  var token = '{{Session::token()}}';
</script>
<script  src="/js/search.js"></script>
@endsection
