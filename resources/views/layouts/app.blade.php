<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'LaraBBS 爱好者社区')" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'LaraBBS')-{{ setting('site_name', 'Laravel') }}</title>
    <!-- Styles -->
{{--    <link href="{{mix('css/app.css')}}" rel="stylesheet">--}}
    <link href="http://static.lovezhz.cn/css/app.css" rel="stylesheet">
    @yield('styles')
</head>
<body>
<div id="app" class="{{ route_class() }}-page">
    @include('layouts._header')
    <div class="container">
        @include('shared._messages')
        @yield('content')
    </div>
    @include('layouts._footer')
</div>


@if (app()->isLocal())
    @include('sudosu::user-selector')
@endif
<!-- Scripts -->
{{--<script src="{{mix('js/app.js')}}"></script>--}}
<script src="http://static.lovezhz.cn/js/app.js"></script>
@yield('scripts')
</body>
</html>