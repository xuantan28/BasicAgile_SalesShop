<div class="content">
<div class="history-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <button onclick="location.href='<?php echo BASE_URL; ?>Account/History';" class="btn btn-light">Transaction history</button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <button onclick="location.href='<?php echo BASE_URL; ?>Account/Product/Purchased';" class="btn <?php echo $model['title'] == 'Purchased' ? "btn-secondary" : "btn-light"; ?>">Purchased products</button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <button onclick="location.href='<?php echo BASE_URL; ?>Account/Product/Favorite';" class="btn <?php echo $model['title'] == 'Favorite' ? "btn-secondary" : "btn-light"; ?>">Favorite products</button>
                    </div>
                </div>
            </div>
            <div class="col-md-9 border-left border-dark">
                <?php if ($model['totalItem'] < 1) : ?>
                    <div style="display:flex;flex-direction:column;justify-content:center;align-items:center">
                        <img style="width:20%;" src="<?php echo IMAGE_URL; ?>/shop.png" />
                        <label style="margin:10px;">No items here</label>
                        <button class="btn btn-success" onclick='location.href="<?php echo BASE_URL; ?>"'><i class="fab fa-shopify"></i> Buy more</button>
                    </div>
                <?php else : ?>
                    <div class="row">
                        <div class="col-md-12" style="flex-wrap:wrap;display: flex;">
                            <?php foreach ($model['listProduct'] as $key => $value) : ?>
                                <div class="purchased-item">
                                    <?php if ($value['Discount'] > 0) : ?>
                                        <div style="position:absolute;top:-15px;left:0px;width:70px;height:70px" title="SALE <?php echo $value['Discount']; ?>% NOW">
                                            <img style="width:100%;height:100%" src="<?php echo IMAGE_URL . '/sale.png'; ?>" alt="">
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($value['Quantity'] < 1) : ?>
                                        <div style="position:absolute;top:0px;right:0px;width:70px;height:70px" title="SOLD OUT">
                                            <img style="width:100%;height:100%" src="<?php echo IMAGE_URL . '/soldout.png'; ?>" alt="">
                                        </div>
                                    <?php endif; ?>
                                    <div class="purchased-image">
                                        <a href="<?php echo BASE_URL . 'Product/Detail/' . $value['ID']; ?>"><img src="<?php echo IMAGE_URL . '/' . $value['Image']; ?>" alt=""></a>
                                    </div>
                                    <div class="purchased-name">
                                        <label style="font-size:1.1em;font-weight:bold;color:#e23434;text-align:center;margin:0"><?php echo $value['ProductName']; ?></label>
                                    </div>
                                    <div class="purchased-ratings">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <small>(69 ratings)</small>
                                    </div>
                                    <?php if ($value['Discount'] > 0) : ?>
                                        <div class="purchased-new-price">
                                            <label style="font-size:1em;font-weight:bold;margin:0;"><?php echo number_format($value['Price'] - ($value['Price'] * ($value['Discount'] / 100)), '0', '', ','); ?> vnđ</label>
                                            <small>-<?php echo $value['Discount']; ?>%</small>
                                        </div>
                                        <div class="purchased-old-price">
                                            <label style="margin:0;text-decoration:line-through"><?php echo number_format($value['Price']); ?> vnđ</label>
                                        </div>
                                    <?php else : ?>
                                        <label style="font-size:1em;font-weight:bold;margin:0;"><?php echo number_format($value['Price'], '0', '', ','); ?> vnđ</label>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- pagination start -->
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <nav style="display:flex;justify-content:center;align-items:center">
                                <ul class="pagination">
                                    <?php if ($model['currentPage'] > 1) : ?>
                                        <li class="page-item"><a class="page-link" href=<?php echo BASE_URL . '/Account/Product/'.$model['title'].'/'; ?>>First</a></li>
                                        <li class="page-item"><a class="page-link" href=<?php echo BASE_URL . '/Account/Product/'.$model['title'].'/' . $model['prevPage']; ?>><i class="fas fa-angle-left text-primary"></i></a></li>
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
                                            <li class="page-item active"><a class="page-link" href=<?php echo BASE_URL . '/Account/Product/'.$model['title'].'/' . $i; ?>><?php echo $i; ?></a></li>
                                        <?php else : ?>
                                            <li class="page-item"><a class="page-link" href=<?php echo BASE_URL . '/Account/Product/'.$model['title'].'/' . $i; ?>><?php echo $i; ?></a></li>
                                        <?php endif; ?>
                                    <?php endfor; ?>

                                    <?php if ($model['currentPage'] < $model['totalPage']) : ?>
                                        <li class="page-item"><a class="page-link" href=<?php echo BASE_URL . '/Account/Product/'.$model['title'].'/' . $model['nextPage']; ?>><i class="fas fa-angle-right text-primary"></i></a></li>
                                        <li class="page-item"><a class="page-link" href=<?php echo BASE_URL . '/Account/Product/'.$model['title'].'/' . $model['totalPage']; ?>>End</a></li>
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