/* js layout start */
	/* update VIEW */
	function updateView(productID){
		$.ajax({
			url: 'http://localhost/BasicShop_Angile/Ajax/updateView',
			method: 'post',
			data: {
				productID: productID
			}
		});
	}

	/* send feedback function */
	function sendFeedback(feedbackID){
		var response = $('#responseContact').val();
		if (response.includes('^')){
			alert('No character ^');
		}
		else if (response == ""){
			alert('At least 1 character!');
		}
		else{
			$.ajax({
				url: 'http://localhost/BasicShop_Angile/Ajax/submitFeedback',
				method: 'post',
				data: {
					feedbackID: feedbackID,
					response: response
				},
				success:function(response){
					if (response){
						loadFeedback(feedbackID);
					}
				}
			});
		}
	}

	/* load feedback function */
	function loadFeedback(feedbackID){
		$.ajax({
			url: 'http://localhost/BasicShop_Angile/Ajax/loadFeedback',
			method: 'post',
			data: {
				feedbackID: feedbackID
			},
			success:function(response){
				$('#contactInfo').html(response);
			}
		});
	}

	// send feedback
	$('#submitContact').click(function(){
		if ($('#id-contact').val()!=""){
			var userName = $('.contact-form #id-contact').val();
			var name = $('.contact-form input[name="contact-name"]').val();
			var email = $('.contact-form input[name="contact-email"]').val();
			var phone = $('.contact-form input[name="contact-phone"]').val();
			var title = $('.contact-form input[name="contact-title"]').val();
			var content = $('.contact-form #contact-area').val();
			$.ajax({
				url: 'http://localhost/BasicShop_Angile/Ajax/sendFeedback',
				method: 'post',
				dataType: 'json',
				data: {
					userName: userName,
					name: name,
					email: email,
					phone: phone,
					title: title,
					content: content
				},
				success:function(response){
					if (response.type='success'){
						$('#successModal').modal();
					}
					else{
						$('#failedModal').modal();
					}
					// $('div[class^="alert-"]').removeClass();
					// $('.row .account-notify').children().addClass('alert-'+response.type+' alert');
					// $('.row .alert').html('<div onclick="closeNotify();" class="close" style="cursor: pointer;font-size:1.2em;">x</div>'+ ((response.type == 'danger')? '<i style="color:red;margin-right:5px;" class="fas fa-times-circle"></i>':'<i style="color:green;margin-right:5px;" class="fas fa-check-circle"></i>') + response.message);
					// $('.row .account-notify').slideDown();
				}
			});
		}
		else{
			$('#loginPermissionModal').modal();
		}
	});

	/* route to history page function */
	function routeToHistory(url){
		if ($('#id-contact').val()!=""){
			window.location.href = url;
		}
		else{
			$('#loginPermissionModal').modal();
		}
	}

	/* check fill input contact form */
	$('.contact-form input[type!="hidden"], #contact-area').keyup(function(){
		var areEmpty = false;
		$('.contact-form input[type!="hidden"]').each(function() {
		  	if ($(this).val() == "") {
				areEmpty = true;
		  	}
		});
		if (areEmpty){
		  	$('#submitContact').addClass('disabled');
		}
		else{
			if ($('#contact-area').val()!=""){
				$('#submitContact').removeClass('disabled');
			}
			else{
				$('#submitContact').addClass('disabled');
			}
		}
	});

	/* format quantity detail product */
	$('#quantity').keyup(function(){
		maxCount = parseInt(document.getElementById('quantity-left').innerHTML);
		valueCount = parseInt(document.getElementById('quantity').value);
		if (valueCount < 1){
			document.getElementById('quantity').value = 1;
		}
		if (valueCount > maxCount){
			document.getElementById('quantity').value = maxCount;
		}
		if (document.getElementById('quantity').value == ''){
			document.getElementById('quantity').value = 1;
		}
	});

	/* change quantity*/
	$('#plus').click(function(){
		maxCount = parseInt(document.getElementById('quantity-left').innerHTML);
		var valueCount = parseInt(document.getElementById('quantity').value);
		valueCount++;
		document.getElementById('quantity').value = valueCount;
		if (valueCount == maxCount) {
			$('#plus').addClass('disable');
		}
		if (valueCount > 1){
			$('#sub').removeClass('disable');
		}
	});
	$('#sub').click(function(){
		maxCount = parseInt(document.getElementById('quantity-left').innerHTML);
		var valueCount = parseInt(document.getElementById('quantity').value);
		valueCount--;
		document.getElementById('quantity').value = valueCount;
		if (valueCount == 1){
			$('#sub').addClass('disable');
		}
		if (valueCount < maxCount) {
			$('#plus').removeClass('disable');
		}
	});
	
	/* change active description menu */
	$('.description-tabs .description-tab-item').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
	});

	/* function move description menu */
	function move(index){
		if (index==1){
			$('.description-slides .newFirst').css('margin-left','0');
		}
		else if (index==2){
			$('.description-slides .newFirst').css('margin-left','-34%');
		}
		else {
			$('.description-slides .newFirst').css('margin-left','-68%');
		}
	};

	/* load product category */
	$('.product-navigation li').click(function(){
		const value = $(this).attr('data-filter');
		if (value == 'all'){
			$('.product-card').show(1000);
		}
		else{
			$('.product-card').not('.'+value).hide('1000');
			$('.product-card').filter('.'+value).show('1000');
		}
	});



	/* add favorite function*/
	function addFavorite(){
		productID = $('#alertModal input[name="id-alert"]').val();
		$.ajax({
			url: 'http://localhost/BasicShop_Angile/Ajax/addFavorite',
			method: 'post',
			data: {
				productID:productID
			},
			success: function(response) {
				if (response){
					$('#successModal').modal();
				}
				else{
					$('#failedModal').modal();
				}
			}
		});
	}

	/* pass data alert modal function*/
	function passDataAlertModal(id,name){
		$('#alertModal input[name="id-alert"]').val(id);
		$('#alertModal label').html(name + ' to your favorite');
		$('#alertModal').modal();
	}

	/* change active product menu */
	$('.product-navigation li').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
	});
	
	/* move image card */
	$('.add-cart-card').click(function(){
		$(this).parent().parent().parent().prev().prev().css({'top':'73%','right':'9%','width':'0%','height':'0%','zIndex':'1000','transition':'1s','opacity':'1'});
		// $.post('./Ajax/getSession',function(response){
		// 	//$('.add-cart-card').parent().parent().parent().prev().prev().css({'top':'73%','right':'9%','width':'0%','height':'0%','zIndex':'1000','transition':'1s'});
		// 	if (response){

		// 	}
		// 	else{
		// 		$('.add-cart-card').parent().parent().parent().prev().prev().css({'zIndex':'0','transition':'0s'});
		// 		alert('Log in to use this button');
		// 	}
		// });
	});
	$('.add-cart-card').mouseout(function(){
		$(this).parent().parent().parent().prev().prev().css({'top':'20%','right':'33%','width':'35%','height':'28%','zIndex':'0','transition':'0s','opacity':'0'});
	});

	/* update password function */
	function updatePassword(){
		var pass = $('input[id=pass]').val();
		var newpass = $('input[id=newpass]').val();
		var confirmnewpass = $('input[id=confirmnewpass]').val();
		$.ajax({
			url: 'http://localhost/BasicShop_Angile/Ajax/updatePassword',
			method: 'post',
			dataType: 'json',
			data: {
				pass: pass,
				newpass: newpass,
				confirmnewpass: confirmnewpass
			},
			success: function(response){
				$('div[class^="alert-"]').removeClass();
				$('.account-pass .account-notify').children().addClass('alert-'+response.type+' alert');
				$('.account-pass .alert').html('<div onclick="closeNotify();" class="close" style="cursor: pointer;font-size:1.2em;">x</div>'+ ((response.type == 'danger')? '<i style="color:red;margin-right:5px;" class="fas fa-times-circle"></i>':'<i style="color:green;margin-right:5px;" class="fas fa-check-circle"></i>') + response.message);
				$('.account-pass .account-notify').slideDown();
			}
		});
	}

	/* update account function */
	function updateAccount(){
		var name = $('input[id=updateName]').val();
		var email = $('input[id=updateEmail]').val();
		var phone = $('input[id=updatePhone]').val();
		var address = $('input[id=updateAddress]').val();
		$.ajax({
			url: 'http://localhost/BasicShop_Angile/Ajax/updateAccount',
			method: 'post',
			data: {
				name: name,
				email: email,
				phone: phone,
				address: address
			},
			success: function(response){
				if (response){
					$('.account-infor .account-notify').slideDown();
					$('html,body').animate({
						scrollTop:0
					}, 'slow');
				}
			}
		});
	}

	/* close notify account function */
	function closeNotify(){
		$('.account-notify').slideUp();
	}

	/* toggle search */
	$('#toggle-search').on('click',function(){
		$('.toggle-search').animate({
			height: 'toggle'
		}, 'slow');
	});

	/* toggle account */
	$('#toggle-account').on('click',function(){
		$('.toggle-account').animate({
			height: 'toggle'
		}, 'slow');
	});
	// const account_toggle = document.getElementById('toggle-account');
	// account_toggle.addEventListener('click',()=>{
	// 	alert('test');
	// });

	/* change active menu button */
	$('.navigation a').click(function(){
		$(this).addClass('active').siblings().removeClass('active');
		// if (!$(this).hasClass('active')){
		// 	$('.navigation a').removeClass('active');
		// 	$(this).addClass('active');
		// }
	});

	/* sticky navbar */
	window.addEventListener("scroll",function(){
		document.getElementById("scroll-header").classList.toggle('fading',window.scrollY > 90);
	});

	/* toggle navigation */
	const menu_toggle = document.querySelector('.menu-toggle');
	const _navigation = document.querySelector('.navigation');
	menu_toggle.addEventListener('click',() => {
		menu_toggle.classList.toggle('active');
		_navigation.classList.toggle('active');
	});

	/* auto slide */
	function clickSlide(i){
		slideShow(i,false);
	}
	var slideIndex = 0;
	slideShow(slideIndex,true);
	function slideShow(i,isRunning) {
		$('.buttons span').removeClass('active');
		var value = 0;
		if (i==0){
			$('#btn1').addClass('active');
		}
		else if(i==1){
			value = -34;
			$('#btn2').addClass('active');
		}
		else{
			value = -68;
			$('#btn3').addClass('active');
		}
		$('.first').css("margin-left",value + "%");
		i = i + 1;
		if (i>2){
			i=0;
		}
		if (isRunning){
			var clearTime = setTimeout(slideShow.bind(null,i,true),5500);
		}
		else{
			var clearTime = setTimeout(slideShow.bind(null,i,false),5500);
			clearTimeout(clearTime);
		}
	}

	/* scroll to top */
	const scroll_Top = document.querySelector('.scroll-top');
	window.addEventListener('scroll',()=>{
		scroll_Top.classList.toggle('active',window.scrollY > 500);
	});
	scroll_Top.addEventListener('click',()=>{
		$('html,body').animate({
			scrollTop:0,
		},'slow');
	});
/* js layout end */