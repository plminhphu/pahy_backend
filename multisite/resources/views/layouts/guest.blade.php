<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('layouts.components.head')
</head>
<body class="bg-light text-dark min-vh-100 d-flex flex-column">
<main class="flex-grow-1 p-4">
@yield('content')
</main>
@include('layouts.components.foot')
</body>
</html>