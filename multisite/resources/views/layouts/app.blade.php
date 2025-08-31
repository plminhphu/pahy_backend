<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('layouts.components.head')
</head>
<body>
	<div class="d-flex flex-md-row">
		@include('layouts.app.menubar')
		<div class="w-100">
			@include('layouts.app.navbar')
			<main class="container">
				@yield('content')
			</main>
		</div>
	</div>
</body>
@include('layouts.components.foot')
@stack('scripts')
</html>