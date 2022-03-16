<?php 
class Ajax extends ViewModel{
    public $account;
    public $product;
    public $contact;
    public function __construct(){
        $this->account = $this->getModel('AccountDAL');
        $this->product = $this->getModel('ProductDAL');
        $this->contact = $this->getModel('ContactDAL');
        $this->order = $this->getModel('OrderDAL');
        $this->orderdetail = $this->getModel('OrderDetailDAL');
    }
    public function loadUserAdmin(){
        $listAccountJSON = json_decode($this->account->getListAccount(),true);
        $output = '';
        foreach ($listAccountJSON as $item){
            $type = $item['Type']==0?'User':'Admin';
            $status = $item['Status']==1?'<label style="color: green; font-weight: bold;">Activated</label>':'<label style="color: red; font-weight: bold;">Locked</label>';
            $switchLock = $item['Status']==1?
            '<button title="Lock" onclick="switchStatus('.$item['ID'].');" class="btn btn-danger mb-2"><i class="fas fa-lock"></i></button>'
            :
            '<button title="Unlock" onclick="switchStatus('.$item['ID'].');" class="btn btn-danger mb-2"><i class="fas fa-lock-open"></i></button>';
            $output .= 
            '
            <tr>
                <td>'.$item['ID'].'</td>
                <td>'.$item['UserName'].'</td>
                <td>'.$item['Name'].'</td>
                <td>'.$item['Email'].'</td>
                <td>'.$item['Phone'].'</td>
                <td>'.$item['CreatedDay'].'</td>
                <td>'.$type.'</td>
                <td>'.$status.'</td>
                <td>
                    <span
                        onclick="passDataEditUser(
                            '.$item['ID'].',
                            \''.$item['Name'].'\',
                            \''.$item['Email'].'\',
                            \''.$item['Phone'].'\',
                            \''.$item['Address'].'\',
                            '.$item['Type'].'
                        );"
                        data-toggle="modal"
                        data-target="#editModal">
                        <button title="Edit" class="btn btn-success mb-2"><i class="fas fa-edit"></i></button>
                    </span>
                    <span onclick="passDataRemove('.$item['ID'].',\''.$item['UserName'].'\');" data-toggle="modal" data-target="#removeModal">
                        <button title="Remove" class="btn btn-danger mb-2"><i class="fas fa-trash-alt"></i></button>
                    </span>
                    <span>
                        '.$switchLock.'
                    </span>
                    <span onclick="passDataReset('.$item['ID'].');" data-toggle="modal" data-target="#resetPassModal">
                        <button title="Reset Password" class="btn btn-warning mb-2"><i class="fas fa-key"></i></button>
                    </span>
                </td>
            </tr>
            ';
        }
        echo $output;
    }
    public function checkNameAdmin(){
        if (json_decode($this->account->checkExist($_POST['inputName']))){
            echo '<label style="color:red;margin:0;font-style:italic;">This name is already existed!</label>';
        }
    }
    public function insertUser(){
        $userName = $_POST['addName'];
        $passWord = password_hash($_POST['addPass'], PASSWORD_DEFAULT);
        $userQuestion = $_POST['addQuestion'];
        $isAdmin = $_POST['isAdmin'];
        echo json_decode($this->account->insertAccount($userName,$passWord,'',$isAdmin));
    }
    public function editUser(){
        echo json_decode($this->account->editAccount($_POST['id'],$_POST['name'],$_POST['email'],$_POST['phone'],$_POST['address'],$_POST['isAdmin']));
    }
    public function loadProductAdmin(){
        $listProductJSON = json_decode($this->product->getListProduct(),true);
        $output = '';
        foreach ($listProductJSON as $item){
            $status = $item['Status']==1?'<label style="color: green; font-weight: bold;">Activated</label>':'<label style="color: red; font-weight: bold;">Locked</label>';
            $linkImage = IMAGE_URL.'/'.$item['Image'];
            $switchLock = $item['Status']==1?
            '<button title="Lock" onclick="switchStatus('.$item['ID'].',1);" class="btn btn-danger mb-2"><i class="fas fa-lock"></i></button>'
            :
            '<button title="Unlock" onclick="switchStatus('.$item['ID'].',1);" class="btn btn-danger mb-2"><i class="fas fa-lock-open"></i></button>';
            $output .= 
            '
            <tr>
                <td>'.$item['ID'].'</td>
                <td>'.$item['ProductName'].'</td>
                <td>'.$item['CateName'].'</td>
                <td><img style="width: 70px; height: 70px;" src="'.$linkImage.'"/></td>
                <td>'.number_format($item['Price'],0,'',',').'</td>
                <td>'.$item['Quantity'].'</td>
                <td>'.$item['Warranty'].' month</td>
                <td>'.$item['Discount'].' %</td>
                <td>'.$item['CreatedDay'].'</td>
                <td>'.$status.'</td>
                <td>
                    <span
                        onclick="passDataEditProduct(
                            \''.IMAGE_URL.'\',
                            '.$item['ID'].',
                            \''.$item['ProductName'].'\',
                            \''.$item['CateName'].'\',
                            \''.$item['Description'].'\',
                            \''.$item['Image'].'\',
                            '.$item['Price'].',
                            '.$item['Quantity'].',
                            '.$item['Warranty'].',
                            '.$item['Discount'].',
                            '.$item['VATFee'].'
                        );"
                        data-toggle="modal"
                        data-target="#editModal">
                        <button title="Edit" class="btn btn-success mb-2"><i class="fas fa-edit"></i></button>
                    </span>
                    <span onclick="passDataRemove('.$item['ID'].',\''.$item['ProductName'].'\');" data-toggle="modal" data-target="#removeModal">
                        <button title="Remove" class="btn btn-danger mb-2"><i class="fas fa-trash-alt"></i></button>
                    </span>
                    <span>
                        '.$switchLock.'
                    </span>
                </td>
            <tr>
            ';
        }
        echo $output;
    }
    public function addProduct(){
        $type = 0;
        $message = '';
        if(isset($_FILES['file']['name'])){
            $fileName = $_FILES['file']['name'];
            $fileExt = explode('.',$fileName);
            $imageFileType = strtolower(end($fileExt));

            $allowed = array("jpg","jpeg","png");

            if(in_array($imageFileType, $allowed)) {
                $location = 'Public/images/'.$fileName;
                if (move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                    $productCate = $this->getModel('ProductCategoryDAL');
                    $cateIDJSON = json_decode($productCate->getIDByCateName($_POST['inputCate']),true);
                    json_decode($this->product->insertProduct($_POST['inputName'],$cateIDJSON,"",$_FILES['file']['name'],$_POST['inputPrice'],0,$_POST['inputQuantity'],$_POST['inputWarranty'],0,$_POST['inputDiscount'],0));
                    $type = 1;
                    $message = 'Add Product Success! :D';
                }
                else{
                    $message = 'Something may error, try again!';
                }
            }
            else{
                $message = '.jpg | .jpeg | .png files only';
            }
        }
        else{
            $message = 'Select an image, please :D';
        }
        $data = array(
            'message'=>$message,
            'type'=>$type
        );
        echo json_encode($data);
    }
    public function editProduct(){
        $type = 0;
        $message = '';
        $linkImage = $_POST['image'];
        if (isset($_FILES['file']['name'])){
            $linkImage = $_FILES['file']['name'];
        }
        $linkImage = explode('/',$linkImage);
        $image = end($linkImage);
        $productCate = $this->getModel('ProductCategoryDAL');
        $cateIDJSON = json_decode($productCate->getIDByCateName($_POST['productCate']),true);
        $oldQuantity = json_decode($this->product->getQuantityByID($_POST['id']),true);
        if (json_decode($this->product->editProduct($_POST['id'],$_POST['productName'],$cateIDJSON,$_POST['description'],$image,$_POST['price'],$oldQuantity,$_POST['quantity'],$_POST['warranty'],$_POST['discount'],$_POST['vatfee']),true)){
            if (!file_exists('Public/images/'.$image)){
                $fileName = $_FILES['file']['name'];
                $fileExt = explode('.',$fileName);
                $imageFileType = strtolower(end($fileExt));

                $allowed = array("jpg","jpeg","png");
                $location = 'Public/images/'.$fileName;
                move_uploaded_file($_FILES['file']['tmp_name'],$location);
            }
            $type = 1;
            $message = 'Edit Product Success!';
        }
        $message = 'Edit Product Failed!';
        $data = array(
            'type'=>$type,
            'message'=>$message
        );
        echo json_encode($data);
    }
    public function addCategory(){
        $productCate = $this->getModel('ProductCategoryDAL');
        $lastID = json_decode($productCate->getLastIDCate(),true);
        if (json_decode($productCate->insertCategory($_POST['cateName'], $lastID + 1),true)){
            echo true;
        }
        echo false;
    }
    public function editCategory(){
        $productCate = $this->getModel('ProductCategoryDAL');
        if (json_decode($productCate->editCategory($_POST['id'], $_POST['cateName'], $_POST['displayOrder']),true)){
            echo true;
        }
        echo false;
    }
    public function switchLock(){
        if ($_POST['type']==0){
            echo json_decode($this->account->switchStatus($_POST['ID']));
        }
        else if ($_POST['type']==1){
            echo json_decode($this->product->switchStatus($_POST['ID']));
        }
        else{
            echo json_decode($this->contact->switchStatus($_POST['ID']));
        }
    }
    public function removeItem(){
        $productCate = $this->getModel('ProductCategoryDAL');
        if ($_POST['type']==0){
            echo json_decode($this->account->removeAccount($_POST['itemID']));
        }
        else if ($_POST['type']==1){
            echo json_decode($this->product->removeProduct($_POST['itemID']));
        }
        else if ($_POST['type']==3){
            echo json_decode($productCate->removeCategory($_POST['itemID']));
        }
        else if ($_POST['type']==4){
            echo json_decode($this->order->removeOrder($_POST['itemID']));
            echo json_decode($this->orderdetail->removeDetailOrder($_POST['itemID']));
        }
    }
    public function resetPass(){
        $newPass = password_hash($_POST['newPass'], PASSWORD_DEFAULT);
        echo json_decode($this->account->resetPassword($_POST['id'],$newPass));
    }
    public function loadFeedback(){
		$feedback = json_decode($this->contact->getFeedbackByID($_POST['feedbackID']),true);
		$content = explode('^',$feedback['Content']);
		$output = '<div class="message mb-2" >';
		$count = 0;
		foreach ($content as $item){
			if ($count % 2 == 0){
				$output .= 
				'
				<div class="p-0 mb-3">
					<div class="p-0 m-0">
						<label class="m-0 text-secondary">'.$feedback['Name'].'</label>
					</div>
					<div class="col-md-12 m-0 user-mess">
						<label>'.$content[$count].'</label>
					</div>
				</div>
				';
			}
			else{
				$output .= 
				'
				<div class="p-0 mb-3">
					<div class="p-0 m-0 d-flex justify-content-end">
						<label class="m-0 text-danger">Admin</label>
					</div>
					<div class="col-md-12 m-0 admin-mess">
						<label>'.$content[$count].'</label>
					</div>
				</div>
				';
			}
			$count = $count + 1;
		}
		$output .= '</div>';
		if ($feedback['Response'] && !$feedback['Status']){
			$output .=
			'
			<form>
            	<textarea class="form-control" id="responseContact" rows="3"></textarea>
            	<div style="padding:0;display:flex;justify-content:flex-end;">
                	<a onclick="sendFeedback('.$feedback['ID'].')" title="Send" class="btn btn-primary">Send</a>
            	</div>      
        	</form>
			';
		}
        if ($feedback['Status']){
            $output .=
            '
                <div class="d-flex justify-content-center">
                    <label class="text-danger font-weight-bold">Turned off conversation <i class="fas fa-comment-slash fa-2x"></i></label>
                </div>
            ';
        }
		echo $output;
	}
    public function submitFeedback(){
		$feedback = json_decode($this->contact->getFeedbackByID($_POST['feedbackID']),true);
		$response = $feedback['Content'].'^'.$_POST['response'];
		if (json_decode($this->contact->updateContent($_POST['feedbackID'],$response),true)){
			json_decode($this->contact->updateResponse($_POST['feedbackID']),true);
			echo true;
		}
		echo false;
	}
    public function loadOrder(){
        $order = $this->getModel('OrderDAL');
        $orderDetail = $this->getModel('OrderDetailDAL');
        $orderJSON = json_decode($order->getOrderByID($_POST['orderID']),true);
        $orderDetailJSON = json_decode($orderDetail->getOrderDetailByOrderID($_POST['orderID']),true);
        $output = 
        '
            <div class="p-0">
                <label>Name:</label><label class="ml-2 font-weight-bold">'.$orderJSON['CustomerName'].'</label>
            </div>
            <div class="p-0">
                <label>Phone:</label><label class="ml-2 font-weight-bold">'.$orderJSON['CustomerPhone'].'</label>
            </div>
            <div class="p-0">
                <label>Email:</label><label class="ml-2 font-weight-bold">'.$orderJSON['CustomerEmail'].'</label>
            </div>
            <div class="p-0">
                <label>Address:</label><label class="ml-2 font-weight-bold">'.$orderJSON['CustomerAddress'].'</label>
            </div>
            <div class="p-0">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
        ';
        $totalPrice = 0;
        $arrayProductID = array();
        $arrayAmountQuantity = array();
        foreach ($orderDetailJSON as $item){
            $totalPrice = $totalPrice + $item['Price'];
            $arrayProductID[] = $item['ProductID'];
            $arrayAmountQuantity[] = $item['Quantity'];
            $output .=
            '
            <tr>
                <td>'.$item['ProductID'].'</td>
                <td><img style="width:80px;height:60px;" src="'.IMAGE_URL.'/'.json_decode($this->product->getProductImageByID($item['ProductID']),true).'" /></td>
                <td>'.json_decode($this->product->getProductNameByID($item['ProductID']),true).'</td>
                <td>'.$item['Quantity'].'</td>
                <td>'.number_format($item['Price'],0,'',',').'</td>
            </tr>
            ';
        }
        $output .=
        '
                        <tr>
                            <td colspan="3"><label class="font-weight-bold">Total price</label></td>
                            <td colspan="2"><label class="font-weight-bold">'.number_format($totalPrice,0,'',',').' vnđ</label></td>
                        </tr>
                    </tbody>
                </table>
        ';
        if ($orderJSON['Status']){
            $output .= 
            '
            <div class="p-0 d-flex justify-content-end">
                <button onclick="orderProcessing('.$orderJSON['ID'].',\''.implode(',',$arrayProductID).'\',\''.implode(',',$arrayAmountQuantity).'\');" class="btn btn-warning">Processing</button>
            </div>
            ';
        }
        else{
            $output .= 
            '
            <div class="p-0 d-flex justify-content-end">
                <button onclick="orderProcessing('.$orderJSON['ID'].',\''.implode(',',$arrayProductID).'\',\''.implode(',',$arrayAmountQuantity).'\');" class="btn btn-success">Accept</button>
            </div>
            ';
        }
        $output .=
        '
            </div>
        ';
        echo $output;
    }
    public function loadListOrder(){
        $listOrderJSON = json_decode($this->order->getListOrder(),true);
        $output = '';
        foreach ($listOrderJSON as $item){
           
            $status = $item['Status']==1?'<label style="color: green; font-weight: bold;">Accepted</label>':'<label style="color: red; font-weight: bold;">Processing</label>';
            $switchLock = $item['Status']==1?
            '<button title="Lock" onclick="switchStatus('.$item['ID'].');" class="btn btn-danger mb-2"><i class="fas fa-history"></i></button>'
            :
            '<button title="Unlock" onclick="switchStatus('.$item['ID'].');" class="btn btn-danger mb-2"><i class="fas fa-check-double"></i></button>';
            $output .= 
            '
            <tr>
                <td>'.$item['ID'].'</td>
                <td>'.$item['CustomerName'].'</td>
                <td>'.$item['CreatedDay'].'</td>
                <td>'.$status.'</td>
                <td>
                    <button onclick="loadOrder('.$item['ID'].')" class="btn btn-secondary mb-2" title="View"><i class="fas fa-eye"></i></button>
                    <span onclick="passDataRemove('.$item['ID'].',\''.$item['CustomerName'].'\');" data-toggle="modal" data-target="#removeModal">
                        <button title="Remove" class="btn btn-danger mb-2"><i class="fas fa-trash-alt"></i></button>
                    </span>
                    <span>
                        '.$switchLock.'
                    </span>
                    <span
                        onclick="passDataEditOrder(
                            '.$item['ID'].',
                            \''.$item['CustomerName'].'\',
                            \''.$item['CustomerEmail'].'\',
                            \''.$item['CustomerPhone'].'\',
                            \''.$item['CustomerAddress'].'\',
                        );"
                        data-toggle="modal"
                        data-target="#editModal">
                        <button title="Edit" class="btn btn-success mb-2"><i class="fas fa-edit"></i></button>
                    </span>
                    
                </td>
            </tr>
            ';
        }
        echo $output;
    }
    public function orderProcessing(){
        $order = $this->getModel('OrderDAL');
        $orderJSON = json_decode($order->getOrderByID($_POST['orderID']),true);
        if (json_decode($order->switchStatus($_POST['orderID']),true)){
            if ($orderJSON['Status']){
                $index = 0;
                foreach ($_POST['arrayProductID'] as $item){
                    json_decode($this->product->updateQuantity($item,$_POST['arrayAmountQuantity'][$index]),true);
                    $index = $index + 1;
                }
            }
            else{
                $index = 0;
                foreach ($_POST['arrayProductID'] as $item){
                    json_decode($this->product->updateQuantity($item,($_POST['arrayAmountQuantity'][$index])*(-1)),true);
                    $index = $index + 1;
                }
            }
            echo true;
        }
        echo false;
    }
    public function editOrder(){
        echo json_decode($this->order->editOrder($_POST['id'],$_POST['name'],$_POST['email'],$_POST['phone'],$_POST['address']));
    }
}
