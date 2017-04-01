<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

         <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
        
    
    </head>

    <body>
         
   

         @if (Auth::guest())

              <div id="guest">

                 @include('layouts.guest-nav')

                 @yield('guest_content')
                 
              </div>  

         @else

             <div id="wrapper">

                @include('layouts.nav-sidebar')

                <div id="page-wrapper">
                  
                    @yield('main_content')
                      
                </div>

             </div>

         @endif    

    

       
     <script src="{{ URL::asset('js/app.js') }}"></script>
     <script src="https://use.fontawesome.com/62b073ec0c.js"></script>

      @yield('add-script')
       
    </body>
</html>
