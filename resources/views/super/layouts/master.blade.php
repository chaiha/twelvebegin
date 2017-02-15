<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Twelve Begin</title>

    <!-- Bootstrap -->
    {{ Html::style('bootstrap/css/bootstrap.min.css') }}
    {{ Html::style('bootstrap/css/bootstrap-theme.min.css') }}
    {{ Html::style('assets/css/ie10-viewport-bug-workaround.css')}}
    {{ Html::style('assets/js/ie-emulation-modes-warning.js')}}
    {{ Html::style('css/navbar.css') }}
      {{ Html::style('css/chai.css') }}
    @yield('styles')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <body id="page-top" class="index">

        @include('super.layouts.partials._navigation')

        @yield('content')
        
        @include('super.layouts.partials._footer')
    
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    @section('js_files')
    @show
    {{ Html::script('js/jquery-3.1.1.min.js')}} 
    {{ Html::script('bootstrap/js/bootstrap.min.js') }}
    {{ Html::script('assets/js/ie10-viewport-bug-workaround.js') }}
  </body>
</html>
