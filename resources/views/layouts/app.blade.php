<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        
         <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
        <script src="https://use.fontawesome.com/62b073ec0c.js"></script>


    </head>

    <body>

     <div id="root">
     </div>

     <script src="{{ URL::asset('js/app.js') }}"></script>
    </body>
</html>
