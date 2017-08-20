<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>Accreditation management software - Govt College of engineering, Kannur</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="Description" content="Developer: Octa.co,
          CEO: Muhammed Shasin P, Category: Education, github: https://github.com/shasin999-gcek">
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

             (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
             (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
             m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
             })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

             ga('create', 'UA-92988784-2', 'auto');
             ga('send', 'pageview');


        </script>


    </head>

    <body>

      <div id="guest">

         @include('layouts.guest-nav')

         @yield('guest_content')

      </div>


     <script src="{{ URL::asset('js/app.js') }}"></script>
     <script src="https://use.fontawesome.com/62b073ec0c.js"></script>

    </body>
</html>
