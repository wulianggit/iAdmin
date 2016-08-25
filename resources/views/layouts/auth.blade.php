<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>i无缺后台管理系统</title>

    <!-- Bootstrap -->
    <link href="{{asset('backend/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{asset('backend/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Animate.css -->
    <link href="{{asset('backend/animate/animate.min.css')}}" rel="stylesheet">

    <!-- NProgress -->
    <link href="{{asset('backend/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="{{asset('backend/build/css/custom.min.css')}}" rel="stylesheet">
  </head>

  <body class="login">
  @yield('content')
  </body>
</html>