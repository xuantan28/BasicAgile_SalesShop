	<div class="content">
		<!-- product-wrapper start -->
		<div class="product-wrapper">
			<!-- single-container start -->
			<div class="single-container">
				<!-- single-top start -->
				<div class="single-top">
					<div id="exzoom" class="exzoom">
						<!-- Images -->
						<div class="exzoom_img_box">
							<ul class='exzoom_img_ul'>
								<li><img src="<?php echo IMAGE_URL . '/' . $model['single']['Image']; ?>" alt=""></li>
								<li><img src="<?php echo IMAGE_URL . '/' . $model['single']['Image']; ?>" alt=""></li>
								<li><img src="<?php echo IMAGE_URL . '/' . $model['single']['Image']; ?>" alt=""></li>
							</ul>
						</div>
						<!-- <a href="https://www.jqueryscript.net/tags.php?/Thumbnail/">Thumbnail</a> Nav-->
						<div class="exzoom_nav"></div>
						<!-- Nav Buttons -->
						<!-- <p class="exzoom_btn">
							<a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
							<a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
						</p> -->
						<!-- <img src="http://localhost/DOTShop/Public/images/laptop1.png" alt=""> -->
					</div>
					<div class="single-detail">
						<div class="detail">
							<span class="single-name"><?php echo $model['single']['ProductName']; ?></span>
							<div class="single-rating">
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star-half-alt"></i>
								<label style="color:#111;">(4.5/5 stars from 169 ratings)</label>
							</div>
							<div class="single-price">
								<div class="price">
									<?php if ($model['single']['Discount'] != 0) : ?>
										<span class="new-price"><?php echo number_format(($model['single']['Price']) - ($model['single']['Price'] * ($model['single']['Discount'] / 100)), 0, '', ','); ?> đ</span>
										<div class="sale">
											<span>-<?php echo $model['single']['Discount']; ?>%</span>
											<span class="old-price"><?php echo number_format($model['single']['Price'], 0, '', ','); ?> đ</span>
										</div>
									<?php else : ?>
										<span class="new-price"><?php echo number_format($model['single']['Price'], 0, '', ','); ?> đ</span>
									<?php endif; ?>
									<h6></h6>
								</div>
							</div>
							<div class="warranty">
								<span>Warranty: </span><span style="font-weight:bold;"><?php echo $model['single']['Warranty']; ?> months.</span>
							</div>
							<div class="quantity">
								<?php if ($model['single']['Quantity'] > 0) : ?>
									<span>Number:</span>
									<div class="group-input" style="color:#111;">
										<button id="sub" class="disable">-</button>
										<input id="quantity" type="text" value="1">
										<button id="plus">+</button>
										(Only <span id="quantity-left" style="font-weight:bold;"><?php echo $model['single']['Quantity']; ?></span> items left)
									</div>
								<?php else : ?>
									<span style="color:red;font-weight:bold;">Sold out! Thanks for your attention :D</span>
								<?php endif; ?>

							</div>
						</div>
						<div class="single-button">
							<?php if ($model['single']['Quantity'] > 0) : ?>
								<a class="add-card" onclick="addCart(<?php echo $model['single']['ID']; ?>,1,2)">Add to card</a>
							<?php endif; ?>
							<a class="add-favorite" onclick="passDataAlertModal(<?php echo $model['single']['ID']; ?>,'<?php echo $model['single']['ProductName']; ?>')">Add to favorite</a>
						</div>
					</div>
				</div>
				<!-- single-top end -->
				<!-- single-bottom start -->
				<div class="single-bottom">
					<h5 style="color:#111;margin-top:10px;">
						Related Product
					</h5>
					<!-- owl-carousel start -->
					<div class="container mt-2 mb-5">
						<!-- owl-carousel-items start -->
						<div class="owl-carousel owl-theme">
							<?php foreach ($model['relatedProduct'] as $item) : ?>
								<div class="product-card" style="width: 90%;">
									<?php if ($item['Discount'] > 0) : ?>
										<div style="position:absolute;top:-15px;left:0px;width:70px;height:70px" title="SALE <?php echo $item['Discount']; ?>% NOW">
											<img style="width:100%;height:100%" src="<?php echo IMAGE_URL . '/sale.png'; ?>" alt="">
										</div>
									<?php endif; ?>
									<?php if ($item['Quantity'] < 1) : ?>
										<div style="position:absolute;top:0px;right:0px;width:70px;height:70px" title="SOLD OUT">
											<img style="width:100%;height:100%" src="<?php echo IMAGE_URL . '/soldout.png'; ?>" alt="">
										</div>
									<?php endif; ?>
									<div class="image-move move">
										<img src="<?php echo IMAGE_URL . '/' . $item['Image']; ?>" alt="">
									</div>
									<div class="image-card">
										<a onclick="updateView(<?php echo $item['ID'] ?>)" href="<?php echo BASE_URL . 'Product/Detail/' . $item['ID']; ?>"><img src="<?php echo IMAGE_URL . '/' . $item['Image']; ?>" alt=""></a>
									</div>
									<div class="content-card">
										<h5><?php echo $item['ProductName']; ?></h5>
										<?php if ($item['Discount'] > 0) : ?>
											<h6 style="margin:0">Price: <?php echo number_format($item['Price'] - ($item['Price'] * $item['Discount'] / 100), 0, '', ','); ?> đ</h6>
											<div style="display:flex;justify-content:center;align-items:center">
												<small style="text-decoration:line-through"><?php echo number_format($item['Price'], 0, '', ','); ?> đ </small> <small> -<?php echo $item['Discount']; ?>%</small>
											</div>
										<?php else : ?>
											<h6>Price: <?php echo number_format($item['Price'], 0, '', ','); ?> đ</h6>
										<?php endif; ?>
										<div class="btn-content-card">
											<a class="view-card" href="<?php echo BASE_URL . 'Product/Detail/' . $item['ID']; ?>">View</a>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
						<!-- owl-carousel-items end -->
					</div>
					<!-- owl-carousel end -->
					<!-- single-description start -->
					<div class="single-description">
						<ul class="description-tabs">
							<li class="description-tab-item active" onclick="move(1);">More Information</li>
							<li class="description-tab-item" onclick="move(2);">Description</li>
							<li class="description-tab-item" onclick="move(3);">Reviews</li>
						</ul>
						<div class="description-slides">
							<div class="description-slide-item newFirst">
								It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
								It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
							</div>
							<div class="description-slide-item">
								Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
								Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
								Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
							</div>
							<div class="description-slide-item">
								There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
							</div>
						</div>
					</div>
					<!-- single-description end -->
				</div>
				<!-- single-bottom end -->
			</div>
			<!-- single-container end -->
		</div>
		<!-- product-wrapper end -->
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

	<!-- success modal -->
	<div class="modal fade" id="successModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 style="color:black;" class="modal-title">Success! <i style="color:green;" class="fas fa-check-circle"></i></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span style="color:black;" aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style="display:flex;justify-content:space-between;align-items:center;">
					<img style="width:20%;" src="<?php echo IMAGE_URL . '/success.png' ?>" alt="">
					<label style="color:black;width:77%;">Added success. Thanks for your attention!. :D</label>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end success modal -->

	<!-- failed modal -->
	<div class="modal fade" id="failedModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 style="color:black;" class="modal-title">Failed! <i class="fas fa-exclamation-triangle text-danger"></i></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span style="color:black;" aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style="display:flex;flex-direction:column;justify-content:space-between;align-items:center;">
					<img style="width:20%;" src="<?php echo IMAGE_URL . '/failed.png' ?>" alt="">
					<span style="color:black;width:77%;">Added failed. This product may already be in your list. Check it out.</span>
					<span style="color:black;width:77%;">For other problems. Contact us here:
						<a href="<?php echo BASE_URL; ?>Contact/Index"><?php echo BASE_URL; ?>Contact/Index</a>
					</span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end success modal -->

	<!-- alert modal -->
	<div class="modal fade" id="alertModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 style="color:black;" class="modal-title">Love this <3< /h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span style="color:black;" aria-hidden="true">&times;</span>
							</button>
				</div>
				<div class="modal-body">
					<input type="hidden" name="id-alert" />
					<span style="color:black">Click 'Add' to add </span><label style="color:#FA08CB;font-weight:bold"></label>
				</div>
				<div class="modal-footer">
					<button onclick="addFavorite()" class="btn btn-primary" data-dismiss="modal">Add</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end login permission modal -->
