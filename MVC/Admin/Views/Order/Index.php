<div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-danger mt-2">Orders</h3>
            </div>
        </div>
        <div class="row contact-table mb-4">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="orderTable" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created Day</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-order">
                            <?php foreach ($model['listOrder'] as $item): ?>
                            <tr>
                                <td><?php echo $item['ID']; ?></td>
                                <td><?php echo $item['CustomerName']; ?></td>
                                <td><?php echo $item['CreatedDay']; ?></td>
                                <td>
                                <?php if ($item['Status']): ?>
                                    <label class="text-success font-weight-bold">Accepted</label>
                                <?php else: ?>
                                    <label class="text-danger font-weight-bold">Processing</label>
                                <?php endif; ?>
                                </td>
                                <td>
                                    <button onclick="loadOrder(<?php echo $item['ID']; ?>)" class="btn btn-secondary mb-2" title="View"><i class="fas fa-eye"></i></button>
                                    <span onclick="passDataRemove(<?php echo $item['ID'] ?>,'<?php echo $item['CustomerName']; ?>');" data-toggle="modal" data-target="#removeModal">
                                        <button title="Remove" class="btn btn-danger mb-2"><i class="fas fa-trash-alt"></i></button>
                                    </span>
                                    <?php if ($item['Status']): ?>
                                        <button title="Processing" onclick="loadOrder(<?php echo $item['ID']; ?>)" class="btn btn-warning mb-2"><i class="fas fa-history"></i></button>
                                    <?php else: ?>
                                        <button title="Accepted" onclick="loadOrder(<?php echo $item['ID']; ?>)" class="btn btn-success mb-2"><i class="fas fa-check-double"></i></button>
                                    <?php endif; ?>
                                    <span
                                    onclick="passDataEditOrder(
                                        <?php echo $item['ID']; ?>,
                                        '<?php echo $item['CustomerName']; ?>',
                                        '<?php echo $item['CustomerEmail']; ?>',
                                        '<?php echo $item['CustomerPhone']; ?>',
                                        '<?php echo $item['CustomerAddress']; ?>',
                                      
                                        
                                    );"
                                    data-toggle="modal"
                                    data-target="#editModal">
                                    <button title="Edit" class="btn btn-success mb-2"><i class="fas fa-edit"></i></button>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 table-message" id="orderInfo">
                  
            </div>
        </div>
    </div>

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
                <input type="hidden" name="id-remove"/>
                Are you sure you wanna remove <label style="font-weight:bold;color:red;"></label> ?
              </div>
              <div class="modal-footer">
                <button onclick="removeItem(4)" type="button" class="btn btn-danger" data-dismiss="modal">Remove</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- end remove modal -->

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
                <form>
                  <input type="hidden" name="id-edit"/>
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" autocomplete="off" name="edit-name" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="edit-email" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="edit-phone" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="edit-address" class="form-control">
                  </div>
            
                  <div class="modal-footer">
                    <button id="editOrder" type="button" class="btn btn-success" data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- end edit modal -->