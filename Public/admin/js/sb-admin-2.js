// change year revenue function
function changeYear(link) {
  var currentYear = new Date().getFullYear();
  var year = $('#year').val();
  if (year < 2000 || year > currentYear) {
    alert('Year between 200 and ' + currentYear + ' only!');
  }
  else {
    window.location.href = link + year;
  }
}

/* order processing function */
function orderProcessing(orderID, stringProductID, stringAmountQuantity) {
  arrayProductID = stringProductID.split(',');
  arrayAmountQuantity = stringAmountQuantity.split(',');
  $.ajax({
    url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/orderProcessing',
    method: 'post',
    data: {
      orderID: orderID,
      arrayProductID: arrayProductID,
      arrayAmountQuantity: arrayAmountQuantity
    },
    success: function (response) {
      if (response) {
        window.history.back();
        location.reload();
        showToast('Nice', 'Switched Success! :D', 1);
      }
      else {
        showToast('Oops', 'Switched Failed! :D', 0);
      }
    }
  });
}

/* load order function */
function loadOrder(orderID) {
  $.ajax({
    url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/loadOrder',
    method: 'post',
    data: {
      orderID: orderID
    },
    success: function (response) {
      $('#orderInfo').html(response);
    }
  });
}

/* load listorder function */
function loadListOrder() {
  $.ajax({
    url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/loadListOrder',
    method: 'post',
    success: function (response) {
      $('.table-order').html(response);
      
    }
  });
  
  
}

// pass data to edit modal order function
function passDataEditOrder(id, name, email, phone, address) {
  $('#editModal input[name="id-edit"]').val(id);
  $('#editModal input[name="edit-name"]').val(name);
  $('#editModal input[name="edit-email"]').val(email);
  $('#editModal input[name="edit-phone"]').val(phone);
  $('#editModal input[name="edit-address"]').val(address);
 
}

 // edit Order
 $('#editOrder').click(function () {
  var id = $('#editModal input[name="id-edit"]').val();
  var name = $('#editModal input[name="edit-name"]').val();
  var email = $('#editModal input[name="edit-email"]').val();
  var phone = $('#editModal input[name="edit-phone"]').val();
  var address = $('#editModal input[name="edit-address"]').val();
  $.ajax({
    url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/editOrder',
    method: 'post',
    data: {
      id: id,
      name: name,
      email: email,
      phone: phone,
      address: address,
    },
    success: function (response) {
      if (response) {
        
        // loadListOrder();
        // loadOrder(id);
        showToast('Nice', 'Edit Order Success! :D :D :D', 1);
        window.setTimeout(function(){location.reload()},1000)
      }
      else {
        showToast('Oops!', 'Edit Order Failed! :D :D :D', 0);
      }
    }
    
  });
});

/* send feedback function */
function sendFeedback(feedbackID) {
  var response = $('#responseContact').val();
  if (response.includes('^')) {
    alert('No character ^');
  }
  else if (response == "") {
    alert('At least 1 character!');
  }
  else {
    $.ajax({
      url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/submitFeedback',
      method: 'post',
      data: {
        feedbackID: feedbackID,
        response: response
      },
      success: function (response) {
        if (response) {
          loadFeedback(feedbackID);
        }
      }
    });
  }
}

/* load feedback function */
function loadFeedback(feedbackID) {
  $.ajax({
    url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/loadFeedback',
    method: 'post',
    data: {
      feedbackID: feedbackID
    },
    success: function (response) {
      $('#contactInfo').html(response);
    }
  });
}

// remove item admin function | default 0 is users, 1 is products, 3 is category
function removeItem(type = 0) {
  var itemID = $('#removeModal input[name="id-remove"]').val();
  $.ajax({
    url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/removeItem',
    method: 'post',
    data: {
      itemID: itemID,
      type: type
    },
    success: function (response) {
      if (response) {
        if (type == 0) {
          loadUserAdmin();
          showToast('Nice', 'Removed User Success! :D', 1);
          
        }
        else if (type == 1) {
          loadProductAdmin();
          showToast('Nice', 'Removed Product Success!', 1);
        }
        else if (type == 4) {
          showToast('Nice', 'Removed Order Success!', 1);
          window.setTimeout(function(){location.reload()},800)
          // loadListOrder();
        }
        else {
          location.reload();
        }
      }
      else {
        if (type == 0) {
          showToast('Oops', 'Removed User Failed! :D', 0);
        }
        else if (type == 1) {
          showToast('Oops', 'Removed Product Failed!', 0);
        }
        else if (type == 4) {
          showToast('Oops', 'Removed Order Failed!', 0);
        }
        else {
          showToast('Oops', 'Removed Category Failed!', 0);
        }
      }
    }
  });
}

// switch lock admin function | default 0 is users, 1 is products, 2 is feedback
function switchStatus(ID, type = 0) {
  $.ajax({
    url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/switchLock',
    method: 'post',
    data: {
      ID: ID,
      type: type
    },
    success: function (response) {
      if (response) {
        if (type == 0) {
          loadUserAdmin();
        }
        else if (type == 1) {
          loadProductAdmin();
        }
        else {
          window.history.back();
          location.reload();
        }
        showToast('Nice', 'Switched Lock Success! :D', 1);
      }
      else {
        showToast('Oops!', 'Switched Lock Failed! :D', 0);
      }
    }
  });
}

// load product admin function
function loadProductAdmin() {
  $.ajax({
    url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/loadProductAdmin',
    method: 'post',
    success: function (response) {
      $('.table-products').html(response);
    }
  });
}

// load user admin function
function loadUserAdmin() {
  $.ajax({
    url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/loadUserAdmin',
    method: 'post',
    success: function (response) {
      $('.table-users').html(response);
    }
  });
}

// pass data to edit modal category function
function passDataEditCategory(id, name, displayorder) {
  $('#editModal input[name="id-edit"]').val(id);
  $('#editModal input[name="edit-cate-name"]').val(name);
  $('#editModal input[name="edit-displayorder"]').val(displayorder);
}

// pass data to edit modal product function
function passDataEditProduct(imageLink, id, name, cateName, description, image, price, quantity, warranty, discount, vatfee) {
  $('#editModal input[name="id-edit"]').val(id);
  $('#editModal input[name="edit-product-name"]').val(name);
  $('#editModal select').val(cateName);
  $('#editModal #edit-description').html(description);
  $('#editImage').attr('src', imageLink + '/' + image);
  $('#editModal input[name="edit-price"]').val(price);
  $('#editModal input[name="edit-quantity"]').val(quantity);
  $('#editModal input[name="edit-warranty"]').val(warranty);
  $('#editModal input[name="edit-discount"]').val(discount);
  $('#editModal input[name="edit-vatfee"]').val(vatfee);
}

// pass data to edit modal user function
function passDataEditUser(id, name, email, phone, address, type) {
  $('#editModal input[name="id-edit"]').val(id);
  $('#editModal input[name="edit-name"]').val(name);
  $('#editModal input[name="edit-email"]').val(email);
  $('#editModal input[name="edit-phone"]').val(phone);
  $('#editModal input[name="edit-address"]').val(address);
  type == 1 ? $('#editModal input[name="edit-isadmin"]').prop('checked', true) : $('#editModal input[name="edit-isadmin"]').prop('checked', false);
}

// pass data to reset pass modal function
function passDataReset(id) {
  $('#resetPassModal input[name="id-resetPass"]').val(id);
}

// pass data to remove modal function
function passDataRemove(id, name) {
  $('#removeModal input[name="id-remove"]').val(id);
  $('#removeModal label').html(name);
}

// show toast function
function showToast(title, content, type = 1) {
  document.getElementById('titleToast').innerHTML = title;
  document.getElementById('contentToast').innerHTML = content;
  if (type == 0) {
    document.getElementById('iconToast').innerHTML = '<i class="fas fa-times-circle fa-2x" style="color:red"></i>';
    $('.toast .toast-header').css("background-color", "red");
  }
  else {
    document.getElementById('iconToast').innerHTML = '<i class="fas fa-check-circle fa-2x" style="color:#7BCA2F"></i>';
    $('.toast .toast-header').css("background-color", "#7BCA2F");
  }
  $('.toast').toast('show');
}
(function ($) {
  "use strict"; // Start of use strict

  // edit category
  $('#editCategory').click(function () {
    var id = $('#editModal input[name="id-edit"]').val();
    var cateName = $('#editModal input[name="edit-cate-name"]').val();
    var displayOrder = $('#editModal input[name="edit-displayorder').val();
    $.ajax({
      url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/editCategory',
      method: 'post',
      data: {
        id: id,
        cateName: cateName,
        displayOrder: displayOrder
      },
      success: function (response) {
        if (response) {
          location.reload();
        }
        else {
          showToast('Nice', 'Edit category failed', 0);
        }
      }
    });
  });

  // add category
  $('#addCategory').click(function () {
    var cateName = $('#addModal input[name="add-cateName"]').val();
    $.ajax({
      url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/addCategory',
      method: 'post',
      data: {
        cateName: cateName
      },
      success: function (response) {
        if (response) {
          location.reload();
          showToast('Nice', 'Add Cate Successfully');
        }
        else {
          showToast('Nice', 'Add Cate Failed', 0);
        }
      }
    });
  });

  // edit product
  $('#editProduct').click(function () {
    var id = $('#editModal input[name="id-edit"]').val();
    var productName = $('#editModal input[name="edit-product-name"]').val();
    var productCate = $('#editModal select option:selected').val();
    var description = $('#editModal #edit-description').val();
    var image = $('#editModal #editImage').attr('src');
    var price = $('#editModal input[name="edit-price"]').val();
    var quantity = $('#editModal input[name="edit-quantity"]').val();
    var warranty = $('#editModal input[name="edit-warranty"]').val();
    var discount = $('#editModal input[name="edit-discount"]').val();
    var vatfee = $('#editModal input[name="edit-vatfee"]').val();
    var file_data = $('#editFileID').prop('files')[0];
    var formData = new FormData();
    formData.append('file', file_data);
    formData.append('id', id);
    formData.append('productName', productName);
    formData.append('productCate', productCate);
    formData.append('description', description);
    formData.append('image', image);
    formData.append('price', price);
    formData.append('quantity', quantity);
    formData.append('warranty', warranty);
    formData.append('discount', discount);
    formData.append('vatfee', vatfee);
    $.ajax({
      url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/editProduct',
      method: 'post',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function (response) {
        if (response.type) {
          loadProductAdmin();
          showToast('Nice', response.message, response.type);
        }
        else {
          showToast('Nice', response.message, response.type);
        }
      }
    });
  });

  // add product
  $('#addProduct').click(function () {
    var name = $('#addModal input[name="add-name"]').val();
    var cate = $('#addModal select option:selected').val();
    var price = $('#addModal input[name="add-price"]').val();
    var quantity = $('#addModal input[name="add-quantity"]').val();
    var warranty = $('#addModal input[name="add-warranty"]').val();
    var discount = $('#addModal input[name="add-discount"]').val();
    var file_data = $('#fileID').prop('files')[0];
    var formData = new FormData();
    formData.append('file', file_data);
    formData.append('inputName', name);
    formData.append('inputCate', cate);
    formData.append('inputPrice', price);
    formData.append('inputQuantity', quantity);
    formData.append('inputWarranty', warranty);
    formData.append('inputDiscount', discount);
    $.ajax({
      url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/addProduct',
      method: 'post',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function (response) {
        if (response.type == 1) {
          loadProductAdmin();
          showToast('Nice', response.message, response.type);
        }
        else {
          showToast('Nice', response.message, response.type);
        }
      }
    });
  });

  // reset pass user
  $('#resetPass').click(function () {
    var id = $('#resetPassModal input[name="id-resetPass"]').val();
    var newPass = $('#resetPassModal input[name="reset-pass"]').val();
    $.ajax({
      url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/resetPass',
      method: 'post',
      data: {
        id: id,
        newPass: newPass
      },
      success: function (response) {
        if (response) {
          loadUserAdmin();
          showToast('Nice', 'Update Password Success!', 1);
        }
        else {
          showToast('Oops!', 'Update Password Failed!', 0);
        }
      }
    });
  });

  // edit user
  $('#editUser').click(function () {
    var id = $('#editModal input[name="id-edit"]').val();
    var name = $('#editModal input[name="edit-name"]').val();
    var email = $('#editModal input[name="edit-email"]').val();
    var phone = $('#editModal input[name="edit-phone"]').val();
    var address = $('#editModal input[name="edit-address"]').val();
    var isAdmin = $('#editModal input[name="edit-isadmin"]').is(':checked');
    $.ajax({
      url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/editUser',
      method: 'post',
      data: {
        id: id,
        name: name,
        email: email,
        phone: phone,
        address: address,
        isAdmin: isAdmin
      },
      success: function (response) {
        if (response) {
          loadUserAdmin();
          showToast('Nice', 'Edit User Success! :D :D :D', 1);
        }
        else {
          showToast('Oops!', 'Edit User Failed! :D :D :D', 0);
        }
      }
    });
  });

  // add user
  $('#addUser').click(function () {
    var addName = $('input[name="add-username"]').val();
    var addPass = $('input[name="add-password"]').val();
    var isAdmin = $('input[name="add-isadmin"]').is(':checked');
    $.ajax({
      url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/insertUser',
      method: 'post',
      data: {
        addName: addName,
        addPass: addPass,
        isAdmin: isAdmin
      },
      success: function (response) {
        if (response) {
          loadUserAdmin();
          showToast('Nice', 'Add User Success! :D');
        }
        else {
          showToast('Oops!', 'Add User Failed! :D', 0);
        }
      }
    });
  });

  // check fill input add category
  $('.add-category-form input').keyup(function () {
    if ($(this).val() == "") {
      $('#addCategory').addClass('disabled');
    }
    else {
      $('#addCategory').removeClass('disabled');
    }
  });

  // check fill input reset pass
  $('form #checkPassReset').keyup(function () {
    if ($(this).val() == "") {
      $('#resetPass').addClass('disabled');
    }
    else {
      $('#resetPass').removeClass('disabled');
    }
  });

  // check fill input edit product
  $('.edit-product-form input').keyup(function () {
    var areEmpty = false;
    $('.edit-product-form input[type!="hidden"][type!="file"]').each(function () {
      if ($(this).val() == "") {
        areEmpty = true;
      }
    });
    if (areEmpty) {
      $('#editProduct').addClass('disabled');
    }
    else {
      $('#editProduct').removeClass('disabled');
    }
  });

  // check fill input add product
  $('.add-product-form input').keyup(function () {
    var areEmpty = false;
    $(".add-product-form input").each(function () {
      if ($(this).val() == "") {
        areEmpty = true;
      }
    });
    if (areEmpty) {
      $('#addProduct').addClass('disabled');
    }
    else {
      $('#addProduct').removeClass('disabled');
    }
  });

  // check user name admin existed
  $('.add-user-form input').keyup(function () {
    var inputName = $('.add-user-form #checkNameAdmin').val();
    $.ajax({
      url: 'http://localhost/BasicAgile_SalesShop/Admin/Ajax/checkNameAdmin',
      method: 'post',
      data: {
        inputName: inputName
      },
      success: function (response) {
        $('#showMessageAdmin').html(response);
        if ($('input[name="add-username"]').val() != "" && $('input[name="add-password"]').val() != "") {
          if (response) {
            $('#addUser').addClass('disabled');
          }
          else {
            $('#addUser').removeClass('disabled');
          }
        }
        else {
          $('#addUser').addClass('disabled');
        }
      }
    });
  });

  // Toggle the side navigation
  $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
    $("body").toggleClass("sidebar-toggled");
    $(".sidebar").toggleClass("toggled");
    if ($(".sidebar").hasClass("toggled")) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Close any open menu accordions when window is resized below 768px
  $(window).resize(function () {
    if ($(window).width() < 768) {
      $('.sidebar .collapse').collapse('hide');
    };
  });

  // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
  $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
    if ($(window).width() > 768) {
      var e0 = e.originalEvent,
        delta = e0.wheelDelta || -e0.detail;
      this.scrollTop += (delta < 0 ? 1 : -1) * 30;
      e.preventDefault();
    }
  });

  // Scroll to top button appear
  $(document).on('scroll', function () {
    var scrollDistance = $(this).scrollTop();
    if (scrollDistance > 100) {
      $('.scroll-to-top').fadeIn();
    } else {
      $('.scroll-to-top').fadeOut();
    }
  });

  // Smooth scrolling using jQuery easing
  $('.scroll-to-top').click(function () {
    $('html, body').animate({
      scrollTop: 0
    }, 'slow');
  });

})(jQuery); // End of use strict
