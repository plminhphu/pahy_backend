<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('layouts.components.head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.20.1/cdn/themes/light.css" />
<script type="module" src="https://cdn.jsdelivr.net/npm/@shoelace-style/shoelace@2.20.1/cdn/shoelace-autoloader.js"></script>
</head>
<body>
@include('layouts.app.navigation')
@isset($header)
<sl-card class="m-2">
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
{{ $header }}
</div>
</sl-card>
@endisset
<main class="m-4">
{{ @$slot }}
</main>
</body>
@include('layouts.components.foot')
</html>
