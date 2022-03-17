<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Users</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span data-toggle="modal" data-target="#addModal">
                <button title="Add User" class="btn btn-primary"><i class="fas fa-user-plus"></i></button>
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>UserName</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Created</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-users">
                        <?php foreach ($model['listAccount'] as $item) : ?>
                            <tr>
                                <td><?php echo $item['ID']; ?></td>
                                <td><?php echo $item['UserName']; ?></td>
                                <td><?php echo $item['Name']; ?></td>
                                <td><?php echo $item['Email']; ?></td>
                                <td><?php echo $item['Phone']; ?></td>
                                <td><?php echo $item['CreatedDay']; ?></td>
                                <td><?php echo ($item['Type'] == 0) ? 'User' : 'Admin'; ?></td>
                                <td>
                                    <?php if ($item['Status'] == 1) : ?>
                                        <label style="color: green; font-weight: bold;">Activated</label>
                                    <?php else : ?>
                                        <label style="color: red; font-weight: bold;">Locked</label>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span onclick="passDataEditUser(
                            <?php echo $item['ID']; ?>,
                            '<?php echo $item['Name']; ?>',
                            '<?php echo $item['Email']; ?>',
                            '<?php echo $item['Phone']; ?>',
                            '<?php echo $item['Address']; ?>',
                            <?php echo $item['Type']; ?>
                          );" data-toggle="modal" data-target="#editModal">
                                        <button title="Edit" class="btn btn-success mb-2"><i class="fas fa-edit"></i></button>
                                    </span>
                                    <span onclick="passDataRemove(<?php echo $item['ID'] ?>,'<?php echo $item['UserName']; ?>');" data-toggle="modal" data-target="#removeModal">
                                        <button title="Remove" class="btn btn-danger mb-2"><i class="fas fa-trash-alt"></i></button>
                                    </span>
                                    <span>
                                        <?php if ($item['Status'] == 1) : ?>
                                            <button title="Lock" onclick="switchStatus(<?php echo $item['ID']; ?>);" class="btn btn-danger mb-2"><i class="fas fa-lock"></i></button>
                                        <?php else : ?>
                                            <button title="Unlock" onclick="switchStatus(<?php echo $item['ID']; ?>);" class="btn btn-danger mb-2"><i class="fas fa-lock-open"></i></button>
                                        <?php endif; ?>
                                    </span>
                                    <span onclick="passDataReset(<?php echo $item['ID'] ?>);" data-toggle="modal" data-target="#resetPassModal">
                                        <button title="Reset Password" class="btn btn-warning mb-2"><i class="fas fa-key"></i></button>
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
                <form class="add-user-form">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" autocomplete="off" id="checkNameAdmin" name="add-username" class="form-control" placeholder="Enter user name ...">
                    </div>
                    <div style="text-align:center;" id="showMessageAdmin"></div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="add-password" class="form-control" placeholder="Enter password ...">
                    </div>
                    <div class="form-group form-check">
                        <input class="form-check-input" name="add-isadmin" type="checkbox">
                        <label class="form-check-label">Is Admin?</label>
                    </div>
                    <div class="modal-footer">
                        <a id="addUser" type="button" class="btn btn-primary disabled" data-dismiss="modal">Save</a>
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
                <form>
                    <input type="hidden" name="id-edit" />
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
                    <div class="form-group form-check">
                        <input class="form-check-input" name="edit-isadmin" type="checkbox">
                        <label class="form-check-label">Is Admin?</label>
                    </div>
                    <div class="modal-footer">
                        <button id="editUser" type="button" class="btn btn-success" data-dismiss="modal">Save</button>
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
                <button onclick="removeItem()" type="button" class="btn btn-danger" data-dismiss="modal">Remove</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- end remove modal -->

<!-- reset pass modal -->
<div class="modal fade" id="resetPassModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">RESET PASSWORD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="id-resetPass" />
                    <div class="form-group">
                        <label>New pass</label>
                        <input type="password" name="reset-pass" id="checkPassReset" class="form-control" placeholder="Enter new password ...">
                    </div>
                    <div class="modal-footer">
                        <a id="resetPass" type="button" class="btn btn-warning disabled" data-dismiss="modal">Save</a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end reset pass modal -->

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