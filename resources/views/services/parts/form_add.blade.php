{!!Form::open(['url' => 'services', 'method' => 'POST'])!!}
 <div class="form-group">
   {{Form::text('service_name',null,['class' => 'form-control','placeholder'=>'Add service'])}}
 </div>
 <div class="pull-right">
   <input type="submit" value="add" class="btn btn-raised btn-success">
 </div>
{!!Form::close()!!}
