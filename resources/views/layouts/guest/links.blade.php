<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="msapplication-TileColor" content="#8b3dff" />
    <meta name="msapplication-config" content="{{ asset('assets/images/favicon/tile.xml') }}" />

    <!-- Favicon icon-->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/loginlogo.png') }}" />

    <title>{{ config('app.name') }} {{ $pageTitle != null ? '- ' . $pageTitle : '' }}</title>

    @include('layouts.guest.styles')
    @yield('styles')
</head>

<body class="theme-blue">

    {{-- <div class="container mt-5"> --}}

    {{-- <x-splash-screen /> --}}
