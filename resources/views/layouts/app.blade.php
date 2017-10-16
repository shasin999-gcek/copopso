<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

         <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="https://bootswatch.com/yeti/bootstrap.min.css">
        <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>
        <script src="https://use.fontawesome.com/62b073ec0c.js"></script>

        // firebase
        <script src="https://www.gstatic.com/firebasejs/4.5.0/firebase.js"></script>
        <script>
          // Initialize Firebase
          var config = {
            apiKey: "AIzaSyDOaEklbkKLlDS7tp0sneNU--gRf3wwpMw",
            authDomain: "copopso-gcek.firebaseapp.com",
            databaseURL: "https://copopso-gcek.firebaseio.com",
            projectId: "copopso-gcek",
            storageBucket: "copopso-gcek.appspot.com",
            messagingSenderId: "108657912049"
          };
          firebase.initializeApp(config);
        </script>

    </head>

    <body>

     <div id="root">
     </div>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
     <script src="{{ URL::asset('js/app.js') }}"></script>
     <script>
       /* (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-92988784-2', 'auto');
        ga('send', 'pageview');*/

     </script>
    </body>
</html>
