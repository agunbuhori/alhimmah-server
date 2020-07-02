<!DOCTYPE html>
<html lang="en">

<head>
	<base href="{{ url('/') }}/" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Belajar Islam - @yield('title')</title>

	@component('components.admin.css')
	@endcomponent
</head>

<body class="navbar-top">
	@component('components.admin.navbar')
	@endcomponent
	<!-- Page container -->
	<div class="page-container">
		<!-- Page content -->
		<div class="page-content">
			@component('components.admin.sidebar')
			@endcomponent
			<!-- Main content -->
			<div class="content-wrapper">
				@yield('back')
				
				<!-- Content area -->
				<div class="content">
					@yield('content')

					@component('components.admin.footer')
					@endcomponent
				</div>
				<!-- /content area -->
			</div>
			<!-- /main content -->
		</div>
		<!-- /page content -->
	</div>
	<!-- /page container -->
	@component('components.admin.js')
	@endcomponent
	<!-- Theme JS files -->
	@stack('js')
	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script>
		axios.defaults.headers.common = {
			'X-Requested-With': 'XMLHttpRequest',
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		};
		$(function() {
			$('.select2').select2({
				minimumResultsForSearch: Infinity
			});

			$('.switchery').each(function(index, el) {
				new Switchery(el)
			});
		});
	</script>
	@stack('script')
	<script type="text/javascript" src="assets/js/plugins/ui/ripple.min.js"></script>
	<!-- /theme JS files -->
</body>

</html>