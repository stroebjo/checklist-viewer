<!doctype html>
<html>
<head>
	<title>@yield('title') - Checklist</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="dist/build/css/style.css" rel="stylesheet">
</head>
<body>

<div class="l-all">

	<header class="navbar-dark bg-inverse p-1 clearfix">
		<a class="navbar-brand" href="{{ url() }}">Checklist viewer</a>
	</header>


	<div class="container">
			@yield('content')
	</div>


	<footer class="l-footer">
	</footer>

	<script src="dist/build/js/main.js"></script>
</div>
</body>
</html>
