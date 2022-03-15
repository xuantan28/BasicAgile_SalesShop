<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $model['title']; ?></title>
	<link rel="icon" href="<?php echo IMAGE_URL; ?>/icon.png" >
	<link rel="stylesheet" href="<?php echo CSS_URL; ?>/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo CSS_URL; ?>/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo CSS_URL; ?>/jquery.exzoom.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<!-- plugin page -->
	<div id="fb-root"></div>
	<!-- <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="gGrEt7Vg"></script> -->
	<!-- plugin page end -->

	<!-- header start -->
	<div class="header" id="scroll-header">
		<!-- header-top start -->
		<div class="header-top" id="test">
			<i class="fas fa-bell notify">
				<!-- <div class="count-notify"><label>0</label></div> -->
			</i>
			<i class="fas fa-shopping-cart cart">
				
			</i>
			<?php if (empty($_SESSION['USER_SESSION'])): ?>
				<a href="<?php echo BASE_URL; ?>Login/Index">Login/Register</a>
			<?php else: ?>
				<div style="display:flex;justify-content:center;align-items:center;">
					<?php if ($_SESSION['USER_TYPE_SESSION']==1): ?>
						<i style="color:red;margin-right:5px;" class="fab fa-galactic-senate fa-2x"></i>
						<label style="margin:0;color:red;font-weight:bold"><?php echo $_SESSION['USER_SESSION']; ?></label>
					<?php else: ?>
						<i style="color:red;margin-right:5px;" class="fab fa-studiovinari fa-2x"></i>
						<label style="margin:0;"><?php echo $_SESSION['USER_SESSION']; ?></label>
					<?php endif; ?>
					<i id="toggle-account" style="margin-bottom:4px;margin-left:5px;" class="fas fa-sort-down"></i>
				</div>
				<div class="toggle-account">
					<div class="account-navigation">
						<a href="<?php echo BASE_URL; ?>Account/Index">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							Account
						</a>
						<a href="<?php echo BASE_URL; ?>Account/UpdatePass">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							Change password
						</a>
						<a href="<?php echo BASE_URL; ?>Cart/Index">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							My cart
						</a>
						<a href="<?php echo BASE_URL; ?>Account/History">
							<span></span>
							<span></span>
							<span></span>
							<span></span>
							History
						</a>
						<button style="margin-top:10px;" onclick="location.href='<?php echo BASE_URL; ?>Login/Logout'" class="btn btn-danger">Log Out</button>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<!-- header-top end -->

		<!-- header-bottom start -->
		<div class="header-bottom">
			<!-- animate-logo start-->
			<div class="animate-logo">
				<a href="<?php echo BASE_URL; ?>"><label style="color:orange;margin:0;">SALES</label> SHOP</a>
				<a href="<?php echo BASE_URL; ?>"><label style="color:orange;margin:0;">MOBILE</label> SHOP</a>
				<a href="<?php echo BASE_URL; ?>"><label style="color:orange;margin:0;">BASICANGILE</label></a>
			</div>
			<!-- animate-logo end-->

			<!-- menu-toggle start -->
			<div class="menu-toggle">
				<div class="bar"></div>
				<div class="bar"></div>
				<div class="bar"></div>
			</div>
			<!-- menu-toggle end -->

			<!-- navigation start -->
			<div class="navigation">
				<a class="active" href="<?php echo BASE_URL; ?>">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					Home
				</a>
				<a href="<?php echo BASE_URL?>Product/Index">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					Products
				</a>
				<a id="toggle-search" style="cursor:pointer;">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					Search
				</a>
				<div class="toggle-search" style="display:none;">
					<form class="search-form" action="<?php echo BASE_URL; ?>Home/Searching" method="POST">
						<div class="form-group row" style="width:100%;">
							<div class="col-sm-12">
								<input type="text" class="form-control" name="searchName" placeholder="Type product name you want to search here ...">
							</div>
						</div>
						<div class="form-group row col-md-12">
							<input type="checkbox" class="form-check-input" name="advancedCheck">
							<label>Advanced searching</label>
						</div>
						<div class="form-group row col-md-12">
							<label class="col-sm-3 col-form-label">Category</label>
							<div class="col-sm-9">
								<select class="form-control" name="selectBox">
									<option selected><label>All</label></option>
									<option><label>Mobiles</label></option>
									<option><label>Tablets</label></option>
									<option><label>Cameras</label></option>
									<option><label>Laptops</label></option>
								</select>
							</div>
						</div>
						<div class="form-group row col-md-12">
							<label class="col-sm-3 col-form-label">Price</label>
							<input class="col-sm-4 form-control" type="text" name="priceFrom" value='0' />
							<label class="col-sm-1 col-form-label">to</label>
							<input class="col-sm-4 form-control" type="text" name="priceTo" value='10.000.000' />
						</div>
						<button class="btn btn-primary" name="searchProduct">Search</button>
					</form>
				</div>
				<a href="<?php echo BASE_URL; ?>Contact/Index">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
					Contact
				</a>
				<?php if (!empty($_SESSION['USER_SESSION']) && $_SESSION['USER_TYPE_SESSION'] == 1): ?>
					<a id="admin-menu" href="<?php echo ADMIN_BASE_URL; ?>">
						<span></span>
						<span></span>
						<span></span>
						<span></span>
						Admin
					</a>
				<?php endif; ?>
			</div>
			<!-- navigation end -->

		</div>
		<!-- header-bottom end -->
	</div>
	<!-- header end -->

	<!-- content start -->
	<?php
		if (file_exists($link.$model['page'].'.php')){
			require_once($link.$model['page'].'.php');
		}
	?>
	<!-- content end -->

	<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>
    <!-- <script>
        window.fbAsyncInit = function() {
        	FB.init({
            	xfbml            : true,
            	version          : 'v10.0'
        	});
        };

        (function(d, s, id) {
          	var js, fjs = d.getElementsByTagName(s)[0];
          	if (d.getElementById(id)) return;
          	js = d.createElement(s); js.id = id;
          	js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
          	fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script> -->

    <!-- Your Plugin chat code -->
    <div class="fb-customerchat"
    	attribution="page_inbox"
        page_id="101879042054755">
    </div>

	<!-- footer start -->
	<div class="footer">
		<div class="container" style="height:100%">
			<div class="row" style="height:100%">
				<div class="col-md-4 d-flex flex-column justify-content-center align-items-start">
					<label class="font-weight-bold mb-2">Contact Us</label>
					<div class="d-flex flex-column justify-content-center">
						<label><i class="fas fa-map-marker-alt mr-2"></i>280 An Dương Vương, Phường 4, Quận 8, TP.Hồ Chí Minh</label>
						<label><i class="fas fa-phone mr-2"></i>01234567892</label>
						<label><i class="fas fa-envelope mr-2"></i>dapamu333@gmail.com</label>
					</div>
				</div>
				<div class="col-md-4 d-flex flex-column justify-content-center align-items-start">
					<label class="font-weight-bold mb-2">Linked</label>
					<div class="d-flex flex-column justify-content-center">
						<label><a href="#">Search</a></label>
						<label><a href="#">Return Policy</a></label>
						<label><a href="#">Privacy Policy</a></label>
						<label><a href="#">Terms of Service</a></label>
					</div>
				</div>
				<!-- <div class="col-md-4 d-flex align-items-center p-0">
					<div class="fb-page fb_iframe_widget" data-href="https://www.facebook.com/DOT-Shop-101879042054755/" data-tabs="timeline" data-width="" data-height="70" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="adapt_container_width=true&amp;app_id=&amp;container_width=0&amp;height=70&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FDOT-Shop-101879042054755%2F&amp;locale=vi_VN&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false&amp;tabs=timeline&amp;width="><span style="vertical-align: bottom; width: 340px; height: 130px;"><iframe name="f378d743050dbf" width="1000px" height="70px" data-testid="fb:page Facebook Social Plugin" title="fb:page Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v10.0/plugins/page.php?adapt_container_width=true&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df79edc7b2582%26domain%3Ddotshop69.000webhostapp.com%26origin%3Dhttp%253A%252F%252Fdotshop69.000webhostapp.com%252Ff168d110a1330dc%26relation%3Dparent.parent&amp;container_width=0&amp;height=70&amp;hide_cover=false&amp;href=https%3A%2F%2Fwww.facebook.com%2FDOT-Shop-101879042054755%2F&amp;locale=vi_VN&amp;sdk=joey&amp;show_facepile=true&amp;small_header=false&amp;tabs=timeline&amp;width=" style="border: none; visibility: visible; width: 340px; height: 130px;" class=""></iframe></span></div>
				</div> -->
			</div>
		</div>
	</div>
	<!-- footer end -->

	<!-- button-to-google-map start -->
		<div title="Click to see shop location" class="scroll-to-map">
			<a target="_blank" href="https://www.google.com/maps/place/280+An+D.+V%C6%B0%C6%A1ng,+Ph%C6%B0%E1%BB%9Dng+4,+Qu%E1%BA%ADn+5,+Th%C3%A0nh+ph%E1%BB%91+H%E1%BB%93+Ch%C3%AD+Minh,+Vi%E1%BB%87t+Nam/@10.7613547,106.6800195,17z/data=!3m1!4b1!4m5!3m4!1s0x31752f1b888ab357:0xc469f6e800231314!8m2!3d10.7613494!4d106.6822082?hl=vi-VN">
				<i class="fas fa-compass fa-2x"></i>
			</a>
		</div>
	<!-- button-to-google-map end -->

	<!-- button-to-top start -->
		<div class="scroll-top">
			<i class="fas fa-chevron-up"></i>
		</div>
	<!-- button-to-top end -->

	<script>
		// var count = 2;
		// setInterval(function(){
		// 	document.getElementById('radio' + count).checked = true;
		// 	count++;
		// 	if (count == 4) {
		// 		count = 1;
		// 	}
		// },4000);
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="<?php echo JS_URL; ?>/layout.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
	<!-- data table bootstrap -->
	<script>
		$(document).ready(function() {
    		var table = $('#dataTable').DataTable({
				lengthMenu: [ 5, 10, 20, 40, 80 ],
				order: [[2,'desc']]
			});
		});
	</script>
	
	<!-- owl-carousel -->
	<script src="<?php echo JS_URL; ?>/owl.carousel.min.js"></script>
	
	<script src="https://maps.googleapis.com/maps/api/js"></script>
	<script>
		function initMap() {
  			const uluru = { lat: 10.761528574877655, lng: 106.68224038320618 };
  			const map = new google.maps.Map(document.getElementById("map"), {
    			zoom: 16,
    			center: uluru,
  			});
  			const contentString =
    			'<div id="content">' +
    			'<div id="siteNotice">' +
    			"</div>" +
    			'<h1 id="firstHeading" class="firstHeading">Uluru</h1>' +
    			'<div id="bodyContent">' +
    			"<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large " +
    			"sandstone rock formation in the southern part of the " +
    			"Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) " +
    			"south west of the nearest large town, Alice Springs; 450&#160;km " +
    			"(280&#160;mi) by road. Kata Tjuta and Uluru are the two major " +
    			"features of the Uluru - Kata Tjuta National Park. Uluru is " +
    			"sacred to the Pitjantjatjara and Yankunytjatjara, the " +
    			"Aboriginal people of the area. It has many springs, waterholes, " +
    			"rock caves and ancient paintings. Uluru is listed as a World " +
    			"Heritage Site.</p>" +
    			'<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">' +
    			"https://en.wikipedia.org/w/index.php?title=Uluru</a> " +
    			"(last visited June 22, 2009).</p>" +
    			"</div>" +
    			"</div>";
  			const infowindow = new google.maps.InfoWindow({
    			content: contentString,
  			});
  			const marker = new google.maps.Marker({
    			position: uluru,
    			map,
    			title: "DOT Shop - 280 An Dương Vương, p.4, q.8, TP.HCm",
  			});
  			marker.addListener("click", () => {
    			infowindow.open(map, marker);
  			});
		}
		google.maps.event.addDomListener(window,'load',initMap);
	</script>

	<script>
		
		$('.owl-carousel').owlCarousel({
			autoplay: 1000,
			autoplayHoverPause: true,
			items: 4,
			nav: true,
			loop: true,
			responsiveClass:true,
			responsive:{
				0:{
					items:1,
					nav:true
				},
				501:{
					items:2,
					nav:true
				},
				701:{
					items:3,
					nav:true
				},
				801:{
					items:4,
					nav:true
				}
			}
		});
	</script>

	<!-- jquery exzoom -->
	<script src="<?php echo JS_URL; ?>/jquery.exzoom.js"></script>
	<script>
		$(function(){
			$("#exzoom").exzoom({
				"autoPlay": false
			});
		});
	</script>
</body>
</html>