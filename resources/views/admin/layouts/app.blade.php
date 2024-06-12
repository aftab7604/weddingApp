<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Wedding description here">
	<meta name="author" content="Wedding">
	<meta name="keywords" content="wedding,keywords,here">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{asset('assets/img/icons/icon-48x48.png')}}" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Wedding</title>

	<link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    @yield('styles')
</head>

<body>
	<div class="wrapper">
        @if(!Route::is('login'))
		@include('admin.partials.sidebar')
        @endif

		<div class="main">
            @if(!Route::is('login'))
			@include('admin.partials.topbar')
            @endif
			
            @yield('content')

			@if(!Route::is('login'))
            @include('admin.partials.footer')
            @endif
		</div>
	</div>

	<script src="{{asset('assets/js/app.js')}}"></script>
    @yield("scripts")
</body>

</html>