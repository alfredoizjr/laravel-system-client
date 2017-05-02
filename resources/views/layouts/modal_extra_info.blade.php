<div class="modal fade" id="extra">
   {!!Form::open(['url' => 'extra', 'method' => 'POST'])!!}
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Insert extra Information</h4>
      </div>
      <div class="modal-body">
        @include('layouts.errors')
          {{Form::text('web_url','',['class' => 'form-control','placeholder'=>'web url '])}}
          {{Form::hidden('client_id',$data->id)}}
      </div>
      <div class="modal-body">
          {{Form::text('hosting_info','',['class' => 'form-control','placeholder'=>'Hosting Info'])}}
      </div>
      <div class="modal-body">
          {{Form::text('hosting_user','',['class' => 'form-control','placeholder'=>'Hosting Account'])}}
      </div>
      <div class="modal-body">
          {{Form::text('hosting_password','',['class' => 'form-control','placeholder'=>'Hosting Account Password'])}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn  btn-raised btn-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn  btn-raised btn-info">Save changes</button>
      </div>
    </div>
  </div>
  {!!Form::close()!!}
</div>
