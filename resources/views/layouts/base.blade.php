<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='icon' href='#' type='image/x-icon'/>
    <title>CRUD App</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Krub:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    @include('layouts.base_css')
</head>
<body>
<div class="wrapper">

    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Footer-->
    <footer class="py-5" style="background-color: rgb(51, 51, 51)">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; 2022 - Ashan Nadeeka</p></div>
    </footer>
</div>

@include('layouts.base_js')
<script type="text/javascript">

</script>
@yield('additional-scripts')
</body>
</html>
