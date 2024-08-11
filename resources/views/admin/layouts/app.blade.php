<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"defer></script>

   <!--for datepicker-->
      <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
       <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"defer></script>

    <!--for datepicker-->



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('hub/dist/css/theme.min.css')}}">
    <link rel="stylesheet" type="text/css" href="styles.css">


   <!--for datepicker-->
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <!--for datepicker-->


</head>
<body>
    <div id="app">

        <x-nwer></x-nwer>

        <main class="py-4">

            @yield('content')
        </main>
    </div>



 <script>
    var dateToday = new Date();
  $( function() {
    $("#datepicker").datepicker({
        dateFormat:"yy-mm-dd",
        showButtonPanel:true,
        numberOfMonths:2,
        minDate:dateToday,
    });
});

  </script>
<style type="text/css">
    body{
        background: #fff;
    }
    .ui-corner-all{
        background: red;
        color: #fff;
    }
    label.btn{
        padding: 0;
    }
    label.btn input{
        opacity: 0;
        position: absolute;
    }
    label.btn span{
        text-align: center;
        padding: 6px 12px;
        display: block;
        min-width: 80px;
    }
    label.btn input:checked+span{
        background-color: rgb(80,110,228);
        color: #fff;
    }
    .navbar{
        background:#6610f2!important;
        color: #fff!important;
    }
</style>

</body>
</html>
