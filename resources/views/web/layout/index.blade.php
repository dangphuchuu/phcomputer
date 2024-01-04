<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="Ansonika">
	<title>{{isset($info->name) ? $info->name : ''}}</title>

	<base href="{{asset('')}}">

	<!-- Favicons-->
	<link rel="shortcut icon" href="web_assets/img/favicon.ico" type="image/x-icon">
	<link rel="apple-touch-icon" type="image/x-icon" href="web_assets/img/apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="web_assets/img/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="web_assets/img/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="web_assets/img/apple-touch-icon-144x144-precomposed.png">

	<!-- GOOGLE WEB FONT -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- BASE CSS -->
	<link href="web_assets/css/bootstrap.custom.min.css" rel="stylesheet">
	<link href="web_assets/css/style.css" rel="stylesheet">
	@yield('css')
	<!-- SPECIFIC CSS -->
	<link href="web_assets/css/home_1.css" rel="stylesheet">



	<!-- YOUR CUSTOM CSS -->
	<link href="web_assets/css/custom.css" rel="stylesheet">

</head>

<body>
	<?php
	use Gloudemans\Shoppingcart\Facades\Cart;
	use Illuminate\Support\Facades\Auth;
	if(Auth::check()){
		$carts =Cart::instance(Auth::user()->id)->content();
	}else{
		$carts =Cart::instance()->content();
	}
	// Cart::destroy();
	// dd($carts);
	?>
	<div id="page">
		@include('sweetalert::alert')
		@include('web.common.header')
		<!-- /header -->

		@yield('content')
		<!-- /main -->

		@include('web.common.footer')
		<!--/footer-->
	</div>
	<!-- page -->

	<div id="toTop"></div><!-- Back to top button -->

	<!-- COMMON SCRIPTS -->
	<script src="web_assets/js/common_scripts.min.js"></script>
	<script src="web_assets/js/main.js"></script>
	<script src="web_assets/js/carousel-home.min.js"></script>
    <script src="admin_assets/js/feather-icons/feather.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js" integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ==" crossorigin="anonymous"></script>
	<script>
    $(".numbers-row").append('<div class="inc button_inc">+</div><div class="dec button_inc">-</div>');
	$(".button_inc").on("click", function () {
		var $button = $(this);
		var oldValue = $button.parent().find("input").val();
		if ($button.text() == "+") {
			var newVal = parseFloat(oldValue) + 1;
			// alert(newVal);
		} else {
			// Don't allow decrementing below zero
			if (oldValue > 1) {
				var newVal = parseFloat(oldValue) - 1;
			} else {
				newVal = 1;
			}
		}
		$button.parent().find("input").val(newVal);
	});
	</script>
	<!-- SPECIFIC SCRIPTS -->
	<!-- <script src="web_assets/js/modernizr.js"></script>
	<script src="web_assets/js/video_header.min.js"></script>
	<script src="web_assets/js/isotope.min.js"></script> -->
	@yield('scripts')
	<!-- <script>
		// Isotope filter
		$(window).on('load', function() {
			var $container = $('.isotope-wrapper');
			$container.isotope({
				itemSelector: '.isotope-item',
				layoutMode: 'masonry'
			});
		});
		$('.isotope_filter').on('click', 'a', 'change', function() {
			var selector = $(this).attr('data-filter');
			$('.isotope-wrapper').isotope({
				filter: selector
			});
		});
	</script> -->
	@yield('script')
</body>

</html>