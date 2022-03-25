/* js login start */
	/* check secret question function */
	function checkSecretQuestion(){
		var userForgot = $('.forgotPass-form input[name="user-forgot"]').val();
		var secretAnswer = $('.forgotPass-form input[name="secret-answer"]').val();
		$.ajax({
			url: '../Ajax/checkSecretQuestion',
			method: 'post',
			data: {
				userForgot: userForgot,
				secretAnswer: secretAnswer
			},
			success: function(response){
				if (response){
					$('#resultCheck').html('<div class="form-group"><label class="text-secondary">Reset your password:</label><input type="password" name="user-resetPass" class="form-control" placeholder="Enter your new password here ..."></div>');
					$('#saveForgotPass').removeClass('disabled');
				}
				else{
					$('#resultCheck').html('<label class="text-danger" style="width:100%;text-align:center;font-style:italic;">Wrong secret answer!</label>');
				}
			}
		});
	}

	/* reset forgot password */
	$('#saveForgotPass').click(function(){
		var userForgot = $('.forgotPass-form input[name="user-forgot"]').val();
		var newPass = $('.forgotPass-form input[name="user-resetPass"]').val();
		$.ajax({
			url: '../Ajax/resetPass',
			method: 'post',
			data: {
				userForgot: userForgot,
				newPass: newPass
			},
			success: function(response){
				$('#forgotPassModal').modal('hide');
				if (response){
					$('#successModal').modal();
				}
				else{
					$('#failedModal').modal();
				}
			}
		});
	});

	/* check username */
	$('.regis-form #checkUserName').on('keyup',function(){
		var name = $(this).val();
		// $.post('../Ajax/checkExist',{userName:name},function(response){
		// 		$('.regis-form #showMessage').html(response);
		// })
		$.ajax({
			url: '../Ajax/checkExist',
			method: 'post',
			data: {userName:name},
			success: function(response){
				$('.regis-form #showMessage').html(response);
			}
		});
	}); 

	/* toggle form */
	$('.option-2 a').click(function(){
		$('form').animate({
			height: 'toggle',
			opacity: 'toggle'
		}, 'slow');
	});

/* js login end */