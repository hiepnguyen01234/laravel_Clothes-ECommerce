<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="icon" href="/assets/images/items/1.jpg" type="image/x-icon" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/assets/css/ui.css" rel="stylesheet">
    <link href="/assets/css/responsive.css" rel="stylesheet">

    <link href="/assets/css/all.min.css" rel="stylesheet">
    <script src="/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/js/bootstrap.bundle.min.js" type="text/javascript"></script>

    <!-- Custom icon Edit, Preview,... for this template -->
    <!-- I don't know why, but the imported bootstrap css above not support this -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
</head>

<body>
    @include('frontend.layout-extend.header') <!-- header //  -->
    <!-- ========================= SECTION PAGE CONTENT ========================= -->
    @yield('content')
    <!-- ========================= SECTION PAGE CONTENT END// ========================= -->
    @include('frontend.layout-extend.footer') <!-- footer //  -->
</body>

</html>
