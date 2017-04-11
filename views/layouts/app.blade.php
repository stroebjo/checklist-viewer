<!doctype html>
<html>
<head>
	<title>@yield('title') - Checklist</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="{{ url('dist/build/css/style.css') }}" rel="stylesheet">

	@yield('head')
</head>
<body>

<div class="l-all">

	<header class="navbar-dark bg-inverse p-1 clearfix">
		<a class="navbar-brand" href="{{ url() }}">Checklist viewer</a>
	</header>


	<div class="container">

			@include('utillities.breadcrumb')


			@yield('content')
	</div>


	<footer class="l-footer">
	</footer>
</div>
<script src="{{ url('dist/build/js/main.min.js') }}"></script>
@if (getenv('TRELLO_APP_KEY'))<script src="https://api.trello.com/1/client.js?key={{ getenv('TRELLO_APP_KEY') }}"></script>@endif
</body>
</html>
