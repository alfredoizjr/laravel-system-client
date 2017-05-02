@if (session('info'))
<div class="alert alert-dismissible alert-info">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong><i class="fa fa-check" aria-hidden="true"></i> Well done! </strong> {{session('info')}}
</div>
@endif
