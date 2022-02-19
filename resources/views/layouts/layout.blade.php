<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') :: YataYat</title>
    
    <link rel="icon" type="image/png" href="{{ asset('images/train.png') }}">

    <link rel="stylesheet" href="{{ asset('packages/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('packages/line-awesome/css/line-awesome.min.css')}}">

    @yield('styles')
</head>

<body>
    <script src="{{ asset('packages/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    @include('layouts.header')
    
    @yield('content')
    
    @include('layouts.footer')

    @yield('after_script')
</body>

</html>