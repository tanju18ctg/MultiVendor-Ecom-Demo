<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/pace/css/pace-theme-default.min.css') }}">
    <script src="{{ asset('/assets/pace/js/pace.min.js') }}"></script>
</head>

<body class="sidebar-mini layout-fixed">
    <div id="app">
        <admin-master></admin-master>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/js/adminlte.js') }}"></script>
</body>

</html>
