
<div class="btn-group btn-group-justified btn-group-raised">
<a href="{{url('/actives')}}" class="{{Request::is('actives') ? "btn btn-info" : "btn" }}">active</a>
<a href="{{url('/clients')}}" class="{{Request::is('clients') ? "btn btn-warning" : "btn" }}">pending</a>
<a href="{{url('/deactivated')}}" class="{{Request::is('deactivated') ? "btn btn-danger" : "btn" }}">Deactivated</a>
</div>
