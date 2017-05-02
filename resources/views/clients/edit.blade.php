@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <br>
        <div class="col-md-6 col-md-offset-3">

         <div class="card">
             <div class="card-heading card-warning"><p><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i> Edit</p></div>

             <div class="card-body">
               @if (session('success'))
               <div class="alert alert-dismissible alert-success">
                 <button type="button" class="close" data-dismiss="alert">×</button>
                 <strong><i class="fa fa-check" aria-hidden="true"></i> Well done! </strong> {{session('success')}}
               </div>
               @endif
               @if (count($errors) > 0)
              <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                     @endforeach
                   </ul>
                </div>
              @endif

             {!!Form::model($data,['route' => ['clients.update', $data->id],'method'=>'PUT'])!!}
              <div class="form-group">
                {{Form::text('business_name',$data->business_name,['class' => 'form-control','placeholder'=>'Business Name'])}}
              </div>
              <div class="form-group">
                {{Form::text('business_phone',$data->business_phone,['class' => 'form-control','placeholder'=>'Business Phone'])}}
              </div>
              <div class="form-group">
                {{Form::text('business_email',$data->business_email,['class' => 'form-control','placeholder'=>'Business Email'])}}
              </div>
              <div class="form-group">
                {{Form::text('name',$data->name,['class' => 'form-control','placeholder'=>'Name of owner'])}}
              </div>
              <div class="form-group">
                {{Form::text('Last',$data->Last,['class' => 'form-control','placeholder'=>'Last Name of owner'])}}
              </div>

              <div class="form-group">
                {{Form::hidden('business_account',$data->business_account)}}
                {{Form::hidden('status',$data->status)}}
              </div>
              <div class="pull-right">
                <a class='btn btn-raised btn-warning' href="{{url('/clients')}}">back to the list</a>
                {{Form::submit('Edit',['class'=>'btn btn-raised btn-success'])}}
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
@if (notify()->ready())

alertify.success( '{{ notify()->message() }}' );

@endif
</script>

@endsection
