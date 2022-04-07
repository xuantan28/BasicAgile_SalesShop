<div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-danger mt-2">Feedbacks</h3>
            </div>
        </div>
        <div class="row contact-table mb-4">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="contactTable" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">User</th>
                                <th scope="col">Title</th>
                                <th scope="col">Created Day</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($model['listFeedback'] as $item): ?>
                            <tr>
                                <?php if($item['Response'] && !$item['Status']): ?>
                                    <td scope="row"><label class="text-danger font-weight-bold"><?php echo $item['ID']; ?></label></td>
                                    <td><label class="text-danger font-weight-bold"><?php echo $item['UserName']; ?></label></td>
                                    <td style="word-break:break-all;"><label class="text-danger font-weight-bold"><?php echo $item['Title'] ?></label></td>
                                    <td><label class="text-danger font-weight-bold"><?php echo $item['CreatedDay']; ?></label></td>
                                <?php else: ?>
                                    <td scope="row"><label><?php echo $item['ID']; ?></label></td>
                                    <td><label><?php echo $item['UserName']; ?></label></td>
                                    <td style="word-break:break-all;"><label><?php echo $item['Title'] ?></label></td>
                                    <td><label><?php echo $item['CreatedDay']; ?></label></td>
                                <?php endif; ?>
                                
                                <td>
                                    <?php if ($item['Status']): ?>
                                        <label class="text-success font-weight-bold">Success</label>
                                    <?php else: ?>
                                        <label class="text-danger font-weight-bold">Processing</label>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button onclick="loadFeedback(<?php echo $item['ID']; ?>);" title="View" class="btn btn-secondary mb-2"><i class="fas fa-eye"></i></button>
                                    <?php if ($item['Status']): ?>
                                        <button onclick="switchStatus(<?php echo $item['ID'] ?>,3);" title="Unlock" class="btn btn-success mb-2"><i class="fas fa-lock-open"></i></button>
                                    <?php else: ?>
                                        <button onclick="switchStatus(<?php echo $item['ID'] ?>,3);" title="Lock" class="btn btn-warning mb-2"><i class="fas fa-lock"></i></button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 table-message" id="contactInfo">
                  
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
        <div style="display:flex;justify-content:space-between;align-item:center;" class="toast-body">
            <div id="iconToast">
              
            </div>
            <div id="contentToast">
                        
            </div>
        </div>
    </div>
    <!-- end toast -->