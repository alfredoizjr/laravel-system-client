@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-md-offset-1">

       <br>

         <div class="card">
             <div class="card-heading card-warning"><p><i class="fa fa-user-plus fa-2x" aria-hidden="true"></i> Insert a new clients</p></div>

             <div class="card-body">
               <div class="col-md-6">
                 @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                       @endforeach
                     </ul>
                  </div>
                @endif
               {!!Form::open(['url' => 'clients', 'files' => true ,'method' => 'POST'])!!}
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
               </div>
              <div class="col-md-6">

                <div class="form-group">
                  {{Form::text('business_address',$data->Last,['class' => 'form-control','placeholder'=>'address include the city'])}}
                </div>
                <div class="form-group">
                  {{Form::text('business_zip',$data->Last,['class' => 'form-control','placeholder'=>'Zip Code'])}}
                </div>
                <div class="form-group">
                  {{Form::text('state',$data->Last,['class' => 'form-control','placeholder'=>'State exp ,FL'])}}
                </div>
                <label for="exampleInputFile">Upload Avatar for this client</label>
                     <input type="file" name='avatar'>
                  <p class="help-block">the image cant be more big them 1.0 mb.</p>

                <div class="form-group">
                  {{Form::hidden('business_account',mt_rand())}}
                  {{Form::hidden('status','p')}}
                  {{Form::hidden('user_id',Auth::user()->id)}}
                </div>
              </div>

              <div class="pull-right">
                <a class='btn btn-raised btn-warning' href="{{url('/clients')}}">back to the list</a>
                {{Form::submit('Send',['class'=>'btn btn-raised btn-success'])}}
              </div>
              </div>
             {!!Form::close()!!}



                </div>
            </div>


        </div>
    </div>
</div>
@endsection
