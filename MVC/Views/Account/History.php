<div class="content">
		<div class="history-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="row">
							<div class="col-md-12">
								<button onclick="location.href='<?php echo BASE_URL; ?>Account/History';" class="btn btn-secondary">Transaction history</button>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-md-12">
								<button onclick="location.href='<?php echo BASE_URL; ?>Account/Product/Purchased';" class="btn btn-light">Purchased products</button>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-md-12">
								<button onclick="location.href='<?php echo BASE_URL; ?>Account/Product/Favorite';" class="btn btn-light">Favotite product</button>
							</div>
						</div>
					</div>
					<div class="col-md-9 border-left border-dark">
						<div class="row">
							<div class="col-md-12">
								<?php if ($model['totalItem'] < 1) : ?>
									<div style="display:flex;flex-direction:column;justify-content:center;align-items:center">
										<img style="width:20%;" src="<?php echo IMAGE_URL; ?>/shop.png" />
										<label style="margin:10px;">No items here</label>
										<button class="btn btn-success" onclick='location.href="<?php echo BASE_URL; ?>"'><i class="fab fa-shopify"></i> Buy more</button>
									</div>
								<?php else : ?>
									<table class="table">
										<thead class="thead-dark">
											<tr>
												<th scope="col">ID</th>
												<th scope="col">Created</th>
												<th scope="col">Products</th>
												<th scope="col">Total price</th>
												<th scope="col">Status</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($model['listTransaction'] as $key => $value) : ?>
												<tr>
													<th style="width:5%;" scope="row"><label><?php echo $value['OrderID']; ?></label></th>
													<th style="width:15%;"><label><?php echo $value['Created']; ?></label></th>
													<th style="width:46%;">
														<label>
															<?php foreach ($value['Products'] as $item) : ?>
																<a class="a" href="<?php echo BASE_URL . 'Product/Detail/' . $item['productID']; ?>"><?php echo '- ' . $item['productName'] . ' (' . $item['quantity'] . ' item - ' . number_format($item['price'] * $item['quantity'], '0', '', ',') . ').<br />'; ?></a>
															<?php endforeach; ?>
														</label>
													</th>
													<th style="width:18%;"><label><?php echo number_format($value['TotalPrice'], '0', '', ','); ?></label></th>
													<th style="width:16%;">
														<?php if ($value['Status'] == 0) : ?>
															<label style="color:red;">In Processing</label>
														<?php else : ?>
															<label style="color:green;">Success</label>
														<?php endif; ?>

													</th>
													<th><a href="<?php echo BASE_URL; ?>Account/Ordered/<?php echo $value['OrderID']; ?>" class="btn btn-secondary" title="View"><i class="fas fa-eye"></i></a></th>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>

									<!-- pagination start -->
									<div class="row">
										<div class="col-md-12">
											<nav style="display:flex;justify-content:center;align-items:center">
												<ul class="pagination">
													<?php if ($model['currentPage'] > 1) : ?>
														<li class="page-item"><a class="page-link" href=<?php echo BASE_URL . '/Account/History/'; ?>>First</a></li>
														<li class="page-item"><a class="page-link" href=<?php echo BASE_URL . '/Account/History/' . $model['prevPage']; ?>><i class="fas fa-angle-left text-primary"></i></a></li>
													<?php endif; ?>

													<?php
													$startPage = 1;
													$endPage = $model['totalPage'];
													if ($model['currentPage'] - ($model['maxPage'] / 2) > 1) {
														$startPage = $model['currentPage'] - ($model['maxPage'] / 2);
													}
													if ($model['currentPage'] + ($model['maxPage'] / 2) < $model['totalPage']) {
														$endPage = $model['currentPage'] + ($model['maxPage'] / 2);
													}
													?>
													<?php for ($i = $startPage; $i <= $endPage; $i++) : ?>
														<?php if ($model['currentPage'] == $i) : ?>
															<li class="page-item active"><a class="page-link" href=<?php echo BASE_URL . '/Account/History/' . $i; ?>><?php echo $i; ?></a></li>
														<?php else : ?>
															<li class="page-item"><a class="page-link" href=<?php echo BASE_URL . '/Account/History/' . $i; ?>><?php echo $i; ?></a></li>
														<?php endif; ?>
													<?php endfor; ?>

													<?php if ($model['currentPage'] < $model['totalPage']) : ?>
														<li class="page-item"><a class="page-link" href=<?php echo BASE_URL . '/Account/History/' . $model['nextPage']; ?>><i class="fas fa-angle-right text-primary"></i></a></li>
														<li class="page-item"><a class="page-link" href=<?php echo BASE_URL . '/Account/History/' . $model['totalPage']; ?>>End</a></li>
													<?php endif; ?>
												</ul>
											</nav>
										</div>
									</div>
									<!-- pagination end -->

								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>