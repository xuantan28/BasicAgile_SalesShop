<div class="content">
	<div class="wrapper">
		<!-- slider start -->
		<div class="slider">
			<div class="slides">
				<div class="slide first">
					<img src="<?php echo IMAGE_URL; ?>/1.png" alt="">
				</div>
				<div class="slide">
					<img src="<?php echo IMAGE_URL; ?>/2.png" alt="">
				</div>
				<div class="slide">
					<img src="<?php echo IMAGE_URL; ?>/3.png" alt="">
				</div>
			</div>
		</div>
		<!-- slider end -->
		<!-- buttons start -->
		<div class="buttons">
			<span id="btn1" onclick="clickSlide(0,false)" class="active"></span>
			<span id="btn2" onclick="clickSlide(1,false)"></span>
			<span id="btn3" onclick="clickSlide(2,false)"></span>
		</div>
		<!-- buttons end -->
		
	</div>
</div>

<!-- login permission modal -->
<div class="modal fade" id="loginPermissionModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 style="color:black;" class="modal-title">Oops!</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:black;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label style="color:black;">Login to use. Thanks! :D</label>
			</div>
			<div class="modal-footer">
				<button onclick="window.location.href='<?php echo BASE_URL; ?>Login/Index'" type="button" class="btn btn-danger" data-dismiss="modal">Login</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- end login permission modal -->

<!-- out quantity modal -->
<div class="modal fade" id="outQuantityModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 style="color:black;" class="modal-title">Oops!</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span style="color:black;" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label style="color:black;">
					This product is sold out. You can choose other products.
					Thanks for your attention!. :D
				</label>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>
<!-- end out quantity modal -->