@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

          <div class="card"><!--head panel-->
            <div class="card-body">
               <p><i class="fa fa-cog " aria-hidden="true"></i> Setting \ Services</p>
            </div>
          </div><!--head panel-->
        <div class="col-md-4"><!-- panel show the services-->
            <div class="card">
                <div class="card-heading card-primary"><p><i class="fa fa-briefcase" aria-hidden="true"></i> Services</p></div>

                <div class="card-body ">
                 @include('layouts.alert_warning')
                 @include('layouts.alert_info')
                   <p>Current services is avaliable</p>

                 @if($service->count() >0)
                    @foreach($service->all() as $service )
                      <p><i class=" fa fa-check-circle-o" aria-hidden="true"></i> {{  $service->service_name}}</p>

                          @include('services.parts.form_del')
                <div class="divider">

                    </div>
                    @endforeach
                @else

                 <p>Services find <span class="label label-warning"> {{$service->count()}}</span></p>

                @endif
                  </ul>
                 </div>
            </div>
        </div><!-- panel show the services-->
        <div class="col-md-8"><!-- panel insert services-->
        <div class="card">
          <div class="card-body">

          <p><i class="fa fa-plug" aria-hidden="true"></i> add services</p>
             @include('layouts.alert_success')
             @include('layouts.errors')
             @include('services.parts.form_add')

           </div>
        </div>

        </div><!-- panel insert services-->
    </div>
</div>
@endsection
