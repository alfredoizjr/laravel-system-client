@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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

             {!!Form::model($data,['route' => ['user.update', $data->id],'method'=>'PUT'])!!}
              <div class="form-group">
                {{Form::text('name',$data->name,['class' => 'form-control','placeholder'=>'Business Name'])}}
              </div>
              <div class="form-group">
                {{Form::text('email',$data->email,['class' => 'form-control','placeholder'=>'Business Phone'])}}
              </div>
              <div class="pull-right">
                <a class='btn btn-raised btn-warning' href="{{url('user')}}">back to the list</a>
                {{Form::submit('Edit',['class'=>'btn btn-raised btn-success'])}}
              </div>
             {!!Form::close()!!}



                </div>
            </div>


        </div>
    </div>
</div>
@endsection
