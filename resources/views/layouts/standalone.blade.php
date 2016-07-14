<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>{{ crminfo('name') }} | Login</title>

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('/dist/css/font-awesome.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{ asset('/dist/css/ionicons.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('/dist/css/AdminLTE.css') }}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{ asset('/plugins/iCheck/square/blue.css') }}">

	<!-- Styles -->
	{{-- <link href="{{ elixir('/css/app.css') }}" rel="stylesheet"> --}}

	<!-- Fonts -->
	<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'> -->
	<!-- <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'> -->

	<!-- Styles -->
	<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->

</head>

<body class="hold-transition login-page">
	@yield('content')

	<!-- jQuery 2.1.4 -->
	<script src="{{ asset('/dist/js/jquery-2.1.4.min.js') }}"></script>
	<!-- jQuery UI 1.11.4 -->
	<!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->

	<script src="{{ asset('/dist/js/bootstrap.min.js') }}"></script>

	{{-- <script src="{{ elixir('/js/app.js') }}"></script> --}}

	<!-- iCheck -->
	<script src="{{ asset('/plugins/iCheck/icheck.min.js') }}"></script>
	<script src="{{ asset('/dist/js/custom.js') }}"></script>
	<script>
		$(function () {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
			$(".alert-fade").fadeTo(7000, 1000).fadeOut(600, function(){
			    $(".alert-fade").alert('close');
			});
		});
	</script>

</body>
</html>
