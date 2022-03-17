<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span data-toggle="modal" data-target="#addModal">
                <button title="Add Product" class="btn btn-primary"><i class="fas fa-plus-circle"></i></button>
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Cate</th>
                            <th>Ima</th>
                            <th>Pri</th>
                            <th>Quan</th>
                            <th>Warranty</th>
                            <th>Discount</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-products">
                        <?php foreach ($model['listProduct'] as $item) : ?>
                            <tr>
                                <td><?php echo $item['ID']; ?></td>
                                <td><?php echo $item['ProductName']; ?></td>
                                <td><?php echo $item['CateName']; ?></td>
                                <td><img style="width: 70px; height: 70px;" src="<?php echo IMAGE_URL . '/' . $item['Image']; ?>" /></td>
                                <td><?php echo number_format($item['Price'], 0, '', ','); ?></td>
                                <td><?php echo $item['Quantity']; ?></td>
                                <td><?php echo $item['Warranty']; ?> month</td>
                                <td><?php echo $item['Discount']; ?> %</td>
                                <td><?php echo $item['CreatedDay']; ?></td>
                                <td>
                                    <?php if ($item['Status'] == 1) : ?>
                                        <label style="color: green; font-weight: bold;">Activated</label>
                                    <?php else : ?>
                                        <label style="color: red; font-weight: bold;">Locked</label>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span onclick="passDataEditProduct(
                              '<?php echo IMAGE_URL; ?>',
                              <?php echo $item['ID']; ?>,
                              '<?php echo $item['ProductName']; ?>',
                              '<?php echo $item['CateName']; ?>',
                              '<?php echo $item['Description']; ?>',
                              '<?php echo $item['Image']; ?>',
                              <?php echo $item['Price']; ?>,
                              <?php echo $item['Quantity']; ?>,
                              <?php echo $item['Warranty']; ?>,
                              <?php echo $item['Discount']; ?>,
                              <?php echo $item['VATFee']; ?>
                            );" data-toggle="modal" data-target="#editModal">
                                        <button title="Edit" class="btn btn-success mb-2"><i class="fas fa-edit"></i></button>
                                    </span>
                                    <span onclick="passDataRemove(<?php echo $item['ID'] ?>,'<?php echo $item['ProductName']; ?>');" data-toggle="modal" data-target="#removeModal">
                                        <button title="Remove" class="btn btn-danger mb-2"><i class="fas fa-trash-alt"></i></button>
                                    </span>
                                    <span>
                                        <?php if ($item['Status'] == 1) : ?>
                                            <button title="Lock" onclick="switchStatus(<?php echo $item['ID']; ?>,1);" class="btn btn-danger mb-2"><i class="fas fa-lock"></i></button>
                                        <?php else : ?>
                                            <button title="Unlock" onclick="switchStatus(<?php echo $item['ID']; ?>,1);" class="btn btn-success mb-2"><i class="fas fa-lock-open"></i></button>
                                        <?php endif; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- add modal -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ADD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formID" class="add-product-form" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" autocomplete="off" name="add-name" class="form-control" placeholder="Enter product name ...">
                    </div>
                    <div class="form-group">
                        <label>Product Category</label>
                        <select class="form-control">
                            <?php foreach ($model['listProductCate'] as $item) : ?>
                                <option><?php echo $item['CateName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" id="fileID" name="add-image" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control" name="add-price" placeholder="Enter price ..." min='0'>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="add-quantity" placeholder="Enter quantity ..." min='0'>
                    </div>
                    <div class="form-group">
                        <label>Warranty</label>
                        <input type="number" class="form-control" name="add-warranty" placeholder="Enter warranty ..." min='0'>
                    </div>
                    <div class="form-group">
                        <label>Discount</label>
                        <input type="number" class="form-control" name="add-discount" placeholder="Enter discount ..." min='0' max='100'>
                    </div>
                    <div class="modal-footer">
                        <a id="addProduct" type="button" class="btn btn-primary disabled" data-dismiss="modal">Save</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end add modal -->

<!-- edit modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">EDIT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="edit-product-form">
                    <input type="hidden" name="id-edit" />
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" autocomplete="off" name="edit-product-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Product Category</label>
                        <select class="form-control">
                            <?php foreach ($model['listProductCate'] as $item) : ?>
                                <option><?php echo $item['CateName']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" id="edit-description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <div>
                            <label>Image</label>
                        </div>
                        <img id="editImage" src="<?php echo IMAGE_URL; ?>/phone1.png" style="width:160px;height:150px;" />
                    </div>
                    <div class="form-group">
                        <input type="file" id="editFileID" name="edit-image" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="edit-price" class="form-control" min='0'>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="edit-quantity" class="form-control" min='0'>
                    </div>
                    <div class="form-group">
                        <label>Warranty</label>
                        <input type="number" name="edit-warranty" class="form-control" min='0'>
                    </div>
                    <div class="form-group">
                        <label>Discount</label>
                        <input type="number" name="edit-discount" class="form-control" min='0' max='100'>
                    </div>
                    <div class="form-group">
                        <label>VAT Fee</label>
                        <input type="number" name="edit-vatfee" class="form-control" min='0'>
                    </div>
                    <div class="modal-footer">
                        <a id="editProduct" type="button" class="btn btn-success" data-dismiss="modal">Save</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end edit modal -->

<!-- remove modal -->
<div class="modal fade" id="removeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">REMOVE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id-remove" />
                Are you sure you wanna remove <label style="font-weight:bold;color:red;"></label> ?
            </div>
            <div class="modal-footer">
                <button onclick="removeItem(1)" type="button" class="btn btn-danger" data-dismiss="modal">Remove</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end remove modal -->

<!-- toast -->
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000" style="position: fixed; top: 2.5rem; right: 1rem; width: 17%;">
    <div class="toast-header">
        <strong id="titleToast" class="mr-auto"></strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div style="display:flex;justify-content:space-between;align-items:center;" class="toast-body">
        <div id="iconToast">

        </div>
        <div id="contentToast">

        </div>
    </div>
</div>
<!-- end toast -->