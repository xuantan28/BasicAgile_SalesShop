<?php
	if (empty($_SESSION['USER_SESSION'])) {
		header('Location:'.BASE_URL.'Login/Index');
	}
?>
	<div class="content">
		<!-- account-wrapper start -->
		<div class="account-wrapper">
			<!-- account-pass start -->
			<div class="account-pass">
				<div class="account-notify" style="display:none;">
					<div class="alert-success alert">
						<!-- <div onclick="closeNotify();" class="close" style="cursor: pointer;font-size:1.2em;">x</div>
						<i style="color:green;" class="fas fa-check-circle"></i>  Update success :D -->
					</div>
				</div>
				<div class="pass">
					<div class="form-group row">
						<label class="col-sm-5 col-form-label">Password</label>
						<div class="col-sm-7">
							<input type="password" id="pass" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-5 col-form-label">New Password</label>
						<div class="col-sm-7">
							<input type="password" id="newpass" class="form-control">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-5 col-form-label">Confirm New Password</label>
						<div class="col-sm-7">
							<input type="password" id="confirmnewpass" class="form-control">
						</div>
					</div>
					<button onclick="updatePassword();" type="submit" class="btn btn-primary mb-2">Update</button>
				</div>
			</div>
			<!-- account-pass end -->
		</div>
		<!-- account-wrapper end -->
	</div>