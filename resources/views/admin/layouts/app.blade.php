<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    @if(Auth::user())--}}
{{--        <meta name="auth-token" content="{{ \Illuminate\Support\Facades\Session::get('access_token')[0] }}">--}}
{{--    @endif--}}
    <link rel="icon" href="{{asset('/img/favicon.png')}}">
    <title>
        @yield('title')
    </title>

    <meta name="description" content="YUPI">

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/stimulsoft/stimulsoft.viewer.office2013.whiteblue.css">
    @yield('css')
</head>
<body>

<div id="app" class="wrapper">
    @yield('content')
</div>


<script src="/stimulsoft/stimulsoft.reports.pack.js"></script>
<script src="/stimulsoft/stimulsoft.dashboards.pack.js"></script>
<script src="/stimulsoft/stimulsoft.reports.chart.pack.js"></script>
<script src="/stimulsoft/stimulsoft.reports.export.pack.js"></script>
<script src="/stimulsoft/stimulsoft.viewer.pack.js"></script>
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>

@yield('js')
</body>
</html>
