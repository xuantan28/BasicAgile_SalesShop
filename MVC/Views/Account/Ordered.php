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
                        <a onclick="history.back()" class="btn btn-secondary ml-2"><i class="fas fa-arrow-left"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-0">
                                <label>Name:</label><label class="ml-2 font-weight-bold"><?php echo $model['order']['CustomerName']; ?></label>
                            </div>
                            <div class="p-0">
                                <label>Phone:</label><label class="ml-2 font-weight-bold"><?php echo $model['order']['CustomerPhone']; ?></label>
                            </div>
                            <div class="p-0">
                                <label>Email:</label><label class="ml-2 font-weight-bold"><?php echo $model['order']['CustomerEmail']; ?></label>
                            </div>
                            <div class="p-0">
                                <label>Address:</label><label class="ml-2 font-weight-bold"><?php echo $model['order']['CustomerAddress']; ?></label>
                            </div>
                            <div class="p-0">
                                <label>Status:</label>
                                <?php if ($model['order']['Status']) : ?>
                                    <label class="ml-2 font-weight-bold text-success">Success</label>
                                <?php else : ?>
                                    <label class="ml-2 font-weight-bold text-danger">In Processing</label>
                                <?php endif; ?>
                            </div>
                            <div class="p-0">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($model['listProductOrdered'] as $item) : ?>
                                            <tr>
                                                <td style="color:black;font-weight:bold"><?php echo $item['ProductID']; ?></td>
                                                <td style="color:black;font-weight:bold"><img style="width:80px;height:60px;" src="<?php echo IMAGE_URL . '/' . $item['ProductImage']; ?>" /></td>
                                                <td style="color:black;font-weight:bold"><?php echo $item['ProductName']; ?></td>
                                                <td style="color:black;font-weight:bold"><?php echo $item['Quantity']; ?></td>
                                                <td style="color:black;font-weight:bold"><?php echo number_format($item['Price'] * $item['Quantity'], 0, '', ','); ?> vnđ</td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="3"><label class="font-weight-bold">Total price</label></td>
                                            <td colspan="2" style="color:black;font-weight:bold"><label class="font-weight-bold"></label><?php echo number_format($model['totalPrice'], 0, '', ','); ?> vnđ</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>