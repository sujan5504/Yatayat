<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') :: YataYat</title>
    
    <link rel="icon" type="image/png" href="{{ asset('images/train.png') }}">
    
    <link rel="stylesheet" href="{{ asset('packages/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('packages/line-awesome/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('packages/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nepali.datepicker.v2.2.min.css') }}">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('packages/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('packages/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/nepali.datepicker.v2.2.min.js') }}"></script>
    <script src="{{ asset('js/dependentDropdown.js') }}"></script>
    <script src="{{ asset('packages/noty/noty.min.js') }}"></script>
    <script src="{{ asset('packages/sweetalert/dist/sweetalert.min.js') }}"></script>

    @yield('styles')
    <style>
        body{
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    
    @include('backpack::inc.alerts')

    @include('layouts.header')
    
    @yield('content')
    
    @include('layouts.footer')

    @yield('after_script')
</body>

</html>