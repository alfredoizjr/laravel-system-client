<!DOCTYPE html>
<html>
<head>
<?php 
   
$style = ['card'=>'width: 100%; margin-top: 7px; margin-bottom: 30px; border-radius: 6px; color: rgba(0,0,0, 0.87); background: #fff;
                   box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);'];

 ?>

</head>
<body>
<div class="container">
<div class="row">
  <div class="col-md-6 col-md-offset-3">

    <div style="{{ $style['card'] }}">
      <div class="card-body">
        <img src="/public/files/other/webpross-logo.png" alt="" />
        <p>
          From Amggmaner Aplication
        </p>
        <div class="divider"></div>
        {{$content}}
      </div>
   </div>
  </div>
</div>

</div>
</body>
</html>
