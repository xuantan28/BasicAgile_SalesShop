<div class="content">
		<div class="wrapper">
			<!-- products start -->
			<div class="products">
				<!-- view-products start -->
				<h5>
					<label style="color:#111;font-size:1.6em;font-weight:bold"><?php echo count($model['listSearch']); ?> results</label>
					<span></span>
				</h5>
				<?php foreach ($model['listSearch'] as $item) : ?>
					<div class="product-card">
						<div class="image-move move">
							<img src="<?php echo IMAGE_URL . '/' . $item['Image']; ?>" alt="">
						</div>
						<div class="image-card">
							<a href="<?php echo BASE_URL . 'Product/Detail/' . $item['ID']; ?>"><img src="<?php echo IMAGE_URL . '/' . $item['Image']; ?>" alt=""></a>
						</div>
						<div class="content-card">
							<h5><?php echo $item['ProductName']; ?></h5>
							<h6>Price: <?php echo number_format($item['Price'], 0, '', ','); ?> đ</h6>
							<div class="btn-content-card">
								<a onclick="updateView(<?php echo $item['ID'] ?>)" class="view-card" href="<?php echo BASE_URL . 'Product/Detail/' . $item['ID']; ?>">View</a>
								<div class="hover-card">
									<i class="fas fa-cart-arrow-down"></i>
									<button onclick="addCart(<?php echo $item['ID']; ?>,1)" style="width: 100%" class="add-cart-card">Add Cart
									</button>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<!-- view-products end -->
			</div>
			<!-- products end -->
		</div>
	</div>