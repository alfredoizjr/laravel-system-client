<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>App</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Styles -->
    <link href="/boots/css/bootstrap.min.css" rel="stylesheet">
    <link href="/alertify/css/alertify.core.css" rel="stylesheet">
    <link href="/alertify/css/alertify.default.css" rel="stylesheet" id="toggleCSS" >
    <link href="/sweet/css/sweetalert.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.min.css" />
    <link href="/boots-d/css/fresh-bootstrap-table.css" rel="stylesheet" />
    <link href="/boots-d/css/bootstrap-material-design.css" rel="stylesheet">
    <link href="/boots-d/css/ripples.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="/zoom/css/lightbox.css" rel="stylesheet">

      <!-- nav Styles -->
    <link href="/css/main.css" rel="stylesheet">
    <link href="/css/rules.css" rel="stylesheet">


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
  @if(Auth::user())
    @include('layouts.nav')
  @endif
    @yield('content')

    <!-- Scripts -->
    <script src="/zoom/js/lightbox-plus-jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>

    <script src="/sweet/js/sweetalert-dev.js"></script>
    <script src="/alertify/js/alertify.min.js"></script>
    <script  src="/js/btn.js"></script>
    <script src="/boots-d/js/material.js"></script>
    <script src="/boots-d/js/ripples.min.js"></script>
    <script src="/boots/js/bootstrap.min.js"></script>
    <script  src="/boots-d/js/bootstrap-table.js"></script>
    <script  src="/boots-d/js/extra-table.js"></script>
    <script  src="/boots-d/js/script-table.js"></script>
    <script  src="/ckeditor/ckeditor.js"></script>
  
    <script>
      $.material.init();
      $("#cke_47").hide();

    </script>
    <!--data piker-->
    <script>
        $( document ).ready(function() {
            $('#fecha').datepicker();
        });

    </script>

@yield('script')
</body>
</html>
