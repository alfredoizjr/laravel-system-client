@if (session('warning'))
<div class="alert alert-dismissible alert-warning">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong><i class="fa fa-check" aria-hidden="true"></i> Alert </strong> {{session('warning')}}
</div>
@endif
