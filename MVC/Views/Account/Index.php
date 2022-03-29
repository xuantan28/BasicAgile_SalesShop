<?php
	if (empty($_SESSION['USER_SESSION'])) {
		header('Location:'.BASE_URL.'Login/Index');
	}
?>
	<div class="content">
		<!-- account-wrapper start -->
		<div class="account-wrapper">
			<!-- account-infor start -->
			<div class="account-infor">
				<div class="account-notify" style="display:none;">
					<div class="alert alert-success">
						<div onclick="closeNotify();" class="close" style="cursor: pointer;font-size:1.2em;">x</div>
						<i style="color:green;" class="fas fa-check-circle"></i>  Update success :D
					</div>
				</div>
				<!-- infor start -->
				<div class="infor">
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Type</label>
						<div class="col-sm-9">
							<input type="text" class="form-control-plaintext" placeholder="<?php echo $model['account']['Type']==0?"User":"Admin"; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Created</label>
						<div class="col-sm-9">
							<input type="text" class="form-control-plaintext" placeholder="<?php echo $model['account']['CreatedDay']; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Secret Question</label>
						<div class="col-sm-9">
							<input type="text" class="form-control-plaintext" placeholder="What is your childhood name?.">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="updateName" value="<?php echo $model['account']['Name']; ?>">
							<small class="form-text text-muted">( Change to update account )</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Email</label>
						<div class="col-sm-9">
							<input type="email" class="form-control" id="updateEmail" value="<?php echo $model['account']['Email']; ?>">
							<small class="form-text text-muted">( Change to update account )</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Phone</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="updatePhone" value="<?php echo $model['account']['Phone']; ?>">
							<small class="form-text text-muted">( Change to update account )</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-3 col-form-label">Address</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="updateAddress" value="<?php echo $model['account']['Address']; ?>">
							<small class="form-text text-muted">( Change to update account )</small>
						</div>
					</div>
					<button onclick="updateAccount();" type="submit" class="btn btn-primary mb-2">Update</button>
				</div>
				<!-- infor end -->
			</div>
			<!-- account-infor end -->
		</div>
		<!-- account-wrapper end -->
	</div>