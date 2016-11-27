<!doctype html>
<html>
<head>
	<title>@yield('title') - Checklist</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="dist/build/css/style.css" rel="stylesheet">
<style>

@media print {

	h1, h2, h3, h4, h5, h6,
	ul, ol, p, pre,
	.card-header	{
		color: #000 !important;
	}

	.navbar-dark,
	.navbar {
		display: none;
	}

	.container {
		width: 100% !important;
	}


	pre {
		border: 0;
	}

	ul, ol {
		padding-left: 40px;
	}

	.card-header {
		display: block !important
	}

	[data-toggle="collapse"] {
		display: none;
	}


	.collapse {
		display: block !important;
	}


	.custom-control-input {
		opacity: 1;
		left: 0;
		z-index: 1;
		top: .2em;
	}

	.custom-control-indicator {
		display: none;
	}

}

</style>
</head>
<body>

<div class="l-all">

	<header class="navbar-dark bg-inverse p-1">
		<a class="navbar-brand" href="{{ url() }}">Checklist viewer</a>
	</header>


	<div class="container">
			@yield('content')
	</div>


	<footer class="l-footer">
	</footer>

	<script src="dist/build/js/jquery.min.js"></script>
	<script src="dist/build/js/tether.min.js"></script>
	<script src="dist/build/js/bootstrap.min.js"></script>
	<script>$('[data-toggle="tooltip"]').tooltip();</script>
</div>
</body>
</html>
