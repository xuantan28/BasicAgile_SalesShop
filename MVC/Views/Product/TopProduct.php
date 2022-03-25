<div class="content">
    <div class="wrapper">

        <!-- products start -->
        <div class="products">

            <!-- view-products start -->
            <h5>
                <h1 style="font-family: 'Big Shoulders Stencil Text', cursive;color:black;text-align:center">Top <?php echo $model['title']; ?></h1>
                <span></span>
            </h5>

            <?php foreach ($model['listProduct'] as $item) : ?>
                <div class="product-card">
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
                    <?php if (isset($_SESSION['VISITED_SESSION']) && in_array($item['ID'], $_SESSION['VISITED_SESSION'])) : ?>
                        <label class="visited">Seen <i class="fas fa-check-double"></i></label>
                    <?php endif; ?>
                    <label class="hot"><i class="far fa-eye"> <label><?php echo $item['View']; ?></label></i></label>
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