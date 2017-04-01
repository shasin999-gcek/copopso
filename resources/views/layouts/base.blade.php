<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        </meta>
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Octaco.co</title>

        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/app.css')}}">
       
    </head>
    <body>
    
    <div id="wrapper">

       @include('layouts.nav-base')
         
         <div id="page-wrapper">
           @yield('content')
            @yield('main_content')
              
         </div>

    </div>        

        <script src="{{ URL::asset('js/app.js') }}"></script>
     <script src="https://use.fontawesome.com/62b073ec0c.js"></script>

      @yield('add-script')
    </body>
</html>