<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"><!--<![endif]-->
<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Github FTP Deployment - Reploy</title>

	<meta name="description" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

	<link rel="shortcut icon" href="{{ URL::to_asset('assets/images/favicon.ico') }}">
	<link rel="apple-touch-icon" href="{{ URL::to_asset('assets/images/apple-touch-icon-57x57.png') }}">
	<link rel="apple-touch-icon" sizes="72x72" href="{{ URL::to_asset('assets/images/apple-touch-icon-72x72.png') }}">
	<link rel="apple-touch-icon" sizes="114x114" href="{{ URL::to_asset('assets/images/apple-touch-icon-114x114.png') }}">

	{{ HTML::style('assets/css/style.css') }}
	{{ HTML::script('assets/js/script-ck.js') }}

	<script>
		var site_url = "{{ URL::base() }}";
	</script>
	@if (Session::has('is_logged_in' && 1==2))
		{{ HTML::script('assets/js/app-ck.js') }}
	@endif

</head>

<body>