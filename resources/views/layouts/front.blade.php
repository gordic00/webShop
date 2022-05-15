<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap5.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    

</head>
<body>
    @include('layouts.inc.fontnavbar')
    
    <div class=" content">
        @yield('content')
    </div>
   
    <!-- Scripts -->
    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>

    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {
        
        loadcart();
        loadwish();

        $ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        function loadcart()
        {
          $.ajax({
            method: "GET",
            url: "/load-cart-data",
            success: function (response) {
              $('.cart-count').html('');
              $('.cart-count').html(response.count);
            }
          });
        }

        function loadwish()
        {
          $.ajax({
            method: "GET",
            url: "/load-wish-data",
            success: function (response) {
              $('.wish-count').html('');
              $('.wish-count').html(response.count);
            }
          });
        }

       });
    </script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
    @yield('scripts')
</body>
</html>
