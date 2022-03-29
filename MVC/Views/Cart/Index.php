<?php
	if (empty($_SESSION['USER_SESSION'])) {
		header('Location:'.BASE_URL.'Login/Index');
	}
?>
	<div class="content">
		<!-- cart-wrapper start -->
		<div class="cart-wrapper">
			<!-- payment start -->
			<div class="payment">
				
			</div>
			<!-- payment end -->
			<div class="cart-container">
				
			</div>
		</div>
		<!-- cart-wrapper end -->
	</div>

    <!-- clear modal -->
    <div class="modal fade" id="clearModal">
        <div class="modal-dialog">
        	<div class="modal-content">
            	<div class="modal-header">
            		<h5 style="color:black;" class="modal-title">Hey</h5>
            		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                		<span style="color:black;" aria-hidden="true">&times;</span>
            		</button>
            	</div>
            	<div class="modal-body">
            		<label style="color:black;">Are you sure you want to clear this cart?</label>
            	</div>
            	<div class="modal-footer">
            		<button onclick="clearCart();" type="button" class="btn btn-danger" data-dismiss="modal">Clear</button>
            		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            	</div>
        	</div>
        </div>
    </div>
    <!-- end clear modal -->

    <!-- remove modal -->
        <div class="modal fade" id="removeModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 style="color:black;" class="modal-title">Remove</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span style="color:black;" aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id-remove"/>
                <span style="color:black;">Are you sure you wanna remove <label style="font-weight:bold;color:red;"></label> ?</span>
              </div>
              <div class="modal-footer">
                <button onclick="removeCart()" type="button" class="btn btn-danger" data-dismiss="modal">Remove</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    <!-- end remove modal -->