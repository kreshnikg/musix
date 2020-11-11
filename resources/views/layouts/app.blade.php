<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
@php($subscribed = Auth::check() && Auth::user()->subscribed())
<body style="{{ $subscribed ? "background-color: #171e31 !important" : "" }}">
    @if($subscribed)
        <div id="app"></div>
    @else
        <div id="guest"></div>
        @yield('content')
    @endauth
</body>
</html>
