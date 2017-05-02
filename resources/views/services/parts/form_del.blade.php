{!! Form::open(['route' => ['services.destroy',$service],'method' => 'DELETE','class'=>'inline-block']) !!}

     {{ Form::hidden('service', $service->id) }}
      <button class="  btn btn-raised btn-danger" type="submit"><i class=" fa fa-trash-o" aria-hidden="true"></i></button>
 {!! Form::close() !!}
