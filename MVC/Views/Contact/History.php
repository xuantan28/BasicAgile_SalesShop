<div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-danger mt-2">History</h3>
            </div>
        </div>
        <div class="row contact-table mb-4">
            <div class="col-md-6">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Created Day</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($model['listFeedback'] as $item): ?>
                            <tr>
                                <?php if(!$item['Response'] && !$item['Status']): ?>
                                    <td scope="row"><label class="text-danger font-weight-bold"><?php echo $item['ID']; ?></label></td>
                                    <td style="word-break:break-all;"><label class="text-danger font-weight-bold"><?php echo $item['Title']; ?></label></td>
                                    <td><label class="text-danger font-weight-bold"><?php echo $item['CreatedDay']; ?></label></td>
                                <?php else: ?>
                                    <td scope="row"><label><?php echo $item['ID']; ?></label></td>
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
                                    <button onclick="loadFeedback(<?php echo $item['ID']; ?>);" title="View" class="btn btn-secondary"><i class="fas fa-eye"></i></button>
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