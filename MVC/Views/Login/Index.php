<!DOCTYPE html> 
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $model['title']; ?></title>
	<link rel="icon" href="<?php echo IMAGE_URL; ?>/icon.png" >
	<link rel="stylesheet" href="<?php echo CSS_URL; ?>/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<!-- login-container-start -->
	<div class="login-container">

		<!-- login-wrapper-start -->
		<div class="login-wrapper">
			<nav class="navbar " style="position:absolute;top:10px;left:10px"  >
				<a class="navbar-brand" href="<?php echo BASE_URL ?>">
					<img src="https://icons.iconarchive.com/icons/graphicloads/100-flat/256/home-icon.png" width="50" height="50" alt="Home"><b>   DOTSHOP</b>
				</a>
			</nav>
			<!-- login-form-start -->
			<form class="login-form" action="<?php echo BASE_URL; ?>Login/Login" method="POST">
				<!-- Form Login -->
				<i class="fas fa-user-circle"></i>
				<input class="user-input" type="text" name="login-username" placeholder="Username ..."  required>
				<input class="user-input" type="password" name="login-password" placeholder="Password ..."  required>
				<div class="option-1">
					<label class="remember-me"><input type="checkbox">Remember Me</label>
					<a style="cursor: pointer;" data-toggle="modal" data-target="#forgotPassModal">Forgot your password</a>
				</div>
				<input class="btn" type="submit" name="login-btn" value="LOGIN">
				<div class="option-2">
					<label>Not have account?<a href="#">Create here</a></label>
				</div>
			</form>
			<!-- login-form-end -->

			<!-- regis-form-start -->
			<!-- regis-form : chuyển 2 form (login <-> register)  -->
			<form class="regis-form" action="<?php echo BASE_URL; ?>Login/Register" method="POST">
				<!-- Form Register -->
				<i class="fas fa-user-plus"></i>
				<input id="checkUserName" autocomplete="off" class="user-input" type="text" name="regis-un" placeholder="Username ..." required>
				<div id="showMessage" style="margin-bottom:10px;color:red;font-style:italic;"></div>
				<input class="user-input" type="text" name="regis-qs" placeholder="What was your childhood name?"  required>
				<input class="user-input" type="password" name="regis-ps" placeholder="Password ..." required>
				<input class="user-input" type="password" name="regis-confirmps" placeholder="Confirm password ..." required>
				<input class="btn" type="submit" name="register-btn" value="REGISTER" >
				<div class="option-2">
					<label>Have account?<a href="#">Login here</a></label>
				</div>
			</form>
			<!-- regis-form-end -->

			<!-- message start -->
			<?php if (isset($model['message']) && isset($model['type'])): ?>
				<?php $color = ($model['type'] == 'error')?"red":"green"; ?>
				<label style="font-size:1.1em;color:<?php echo $color; ?>;font-style:italic;">
					<?php
						echo $model['message'];
					?>
				</label>
			<?php endif; ?>
			<!-- kết thúc tin nhắn -->
		</div>
		<!-- kết thúc trình bao bọc đăng nhập -->
	</div>
	<!-- kết thúc vùng chứa đăng nhập -->
	<!-- Bắt đầu hiệu ứng chuyển động Bubbles 1248 -->
	<div>
		<ul class="bubbles">
			<li><h1></h1></li>
			<li><h1></h1></li>
			<li><h3><img src="https://indyme.com/wp-content/uploads/2020/11/shopping-cart-icon.png" width="150px" height="150px"></h3></li>
			<li><h1></h1></li>
			<li><h1></h1></li>
			<li><h3><img src="https://img.icons8.com/bubbles/2x/admin-settings-male.png" width="150px" height="150px"></h3></li>
			<li><h1></h1></li>
			<li><h1></h1></li>
			<li><h3><img src="https://nongdan.pro/wp-content/uploads/2017/05/shop-icon.png" width="150px" height="150px"></h3></li>
			<li><h1></h1></li>
			<li><h1></h1></li>
			<li><h1></h1></li>

		</ul>
	</div>

	<!-- start forgot pass modal -->
	<div class="modal fade" id="forgotPassModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 style="color:black;" class="modal-title">Forgot your password</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span style="color:black;" aria-hidden="true">&times;</span>
							</button>
				</div>
				<div class="modal-body">
					<form class="forgotPass-form">
						<div class="form-group">
  							<label class="text-secondary">User name</label>
    						<input type="text" name="user-forgot" class="form-control" placeholder="Enter username you forgot here ...">
  						</div>
 						<div class="form-group">
    						<input type="text" class="form-control" value="What was your childhood name?" readonly="">
  						</div>
  						<div class="form-group">
  							<label class="text-secondary">Answer secret question:</label>
    						<input type="text" name="secret-answer" class="form-control" placeholder="Enter your answer here ...">
  						</div>
  						<div class="form-group">
  							<a onclick="checkSecretQuestion()" class="btn btn-success">Check</a>
  						</div>
  						<div id="resultCheck">
  							
  						</div>
					</form>
				</div>
				<div class="modal-footer">
					<a id="saveForgotPass" class="btn btn-warning disabled">Save</a>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end forgot pass modal -->

	<!-- success modal -->
	<div class="modal fade" id="successModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 style="color:black;" class="modal-title">Success! <i class="fas fa-check-circle text-success"></i></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span style="color:black;" aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style="display:flex;flex-direction:column;justify-content:space-between;align-items:center;">
					<img style="width:20%;" src="<?php echo IMAGE_URL . '/success.png' ?>" alt="">
					<span style="color:black;width:77%;">Reset password successfully!.</span>
					<span style="color:black;width:77%;">For other problems. Contact us here:
						<a href="<?php echo BASE_URL; ?>Contact/Index"><?php echo BASE_URL; ?>Contact/Index</a>
					</span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end success modal -->

	<!-- failed modal -->
	<div class="modal fade" id="failedModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 style="color:black;" class="modal-title">Failed! <i class="fas fa-exclamation-triangle text-danger"></i></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span style="color:black;" aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style="display:flex;flex-direction:column;justify-content:space-between;align-items:center;">
					<img style="width:20%;" src="<?php echo IMAGE_URL . '/failed.png' ?>" alt="">
					<span style="color:black;width:77%;">Something went wrong.</span>
					<span style="color:black;width:77%;">For other problems. Contact us here:
						<a href="<?php echo BASE_URL; ?>Contact/Index"><?php echo BASE_URL; ?>Contact/Index</a>
					</span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
				</div>
			</div>
		</div>
	</div>
	<!-- end failed modal -->


	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<!-- Chuyển sang register -->
	<script src="<?php echo JS_URL; ?>/login.js"></script>

</body>
</html>