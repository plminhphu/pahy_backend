<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('layouts.components.head')
</head>
<body class="bg-light text-dark min-vh-100">
	@include('layouts.app.navigation')
	<div class="container-fluid">
		<div class="row">
			<div class="col-auto p-0">
				@include('layouts.app.sidenav')
			</div>
			<div class="col ps-md-0">
				<main class="p-4">
					@yield('content')
				</main>
			</div>
		</div>
	</div>
	@include('layouts.components.foot')
</body>
</html>