<?php
class Api extends ViewModel{
    protected $products;
    public function __construct(){
        $this->products = $this->getModel('ProductDAL');
        $this->account = $this->getModel('AccountDAL');
	}

    /* ------------------------ Accounts API Start ------------------------ */
    // url/Admin/Api/ChangePassword
    public function ChangePassword(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);

        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $accountJSON = json_decode($this->account->getAccountByID($token->ID),true);
                $message = '';
                $type = false;
                if (password_verify($obj['OldPass'], $accountJSON['PassWord'])){
                    if ($obj['NewPass'] == $obj['ConfirmNewPass']){
                        if (json_decode($this->account->updatePasswordByID($token->ID,password_hash($obj['NewPass'], PASSWORD_DEFAULT)),true)){
                            $message = 'Update success :D.';
                            $type = true;
                        }
                        else{
                            $message = 'Change password failed. Maybe something going wrong. \nCONTACT us for more information and resolve';
                        }
                    }
                    else{
                        $message = 'New password are not synchronized :D.';
                    }
                }
                else{
                    $message = 'Old password is incorrect :D.';
                }
                $array = array();
                $array['Message'] = json_encode($message);
                $array['Type'] = json_encode($type);
                print_r(json_encode($array));
            }
        }
        catch(Exception $e){
            echo $e;
        }
    }
    // url/Admin/Api/Login
    public function Login(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);

        $checkLoginJSON = json_decode($this->account->checkLogin($obj["UserName"]),true);
		if ($checkLoginJSON['Status']!=-1){
			if ($checkLoginJSON['Status']!=1){
				echo "{\"token\":\"not activated\"}";
			}
			else{
				if (password_verify($obj["PassWord"],$checkLoginJSON['PassWord'])) {
                    $accountJSON = json_decode($this->account->getAccountByName($obj["UserName"]),true);
					$token = array();
                    $token["ID"] = $accountJSON["ID"];
                    $token["UserName"] = $accountJSON["UserName"];
                    $token["Name"] = $accountJSON["Name"];
                    $token["Email"] = $accountJSON["Email"];
                    $token["Type"] = $accountJSON["Type"];
                    $token["Expire"] = time() + (7*24*60*60); // Token period is 7 days 24 hours 60 minutes 60 seconds

                    $JWT = JWT::encode($token,"SECRET_KEY");
                    echo JsonHelper::getJson("token",$JWT);
				}
				else{
					echo "{\"token\":\"wrong\"}";
				}
			}
		}
		else{
            echo "{\"token\":\"wrong\"}";
		}
    }
    // url/Admin/Api/Register
    public function Register(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);

        try{
            // 1 - Register Successfully
            // 2 - UserName Existed
            // 3 - Old-New PassWord Conflict
            // 4 - Register Failed
            if ($obj['PassWord'] != $obj['ConfirmPass']) {
                echo json_encode(3);
            }
            else {
                if (json_decode($this->account->checkExist($obj['UserName']),true)) {
                    echo json_encode(2);
                }
                else {
                    $passWord = password_hash($obj['PassWord'], PASSWORD_DEFAULT);
                    if (json_decode($this->account->insertAccount($obj['UserName'],$passWord),true)){
                        echo json_encode(1);
                    }
                    else{
                        echo json_encode(4);
                    }
                }
            }
        }
        catch(Exception $e){
            echo $e;
        }
    }
    // url/Admin/Api/CheckExistUserName
    public function CheckExistUserName($userName){
        echo $this->account->checkExist($userName);
    }
    // url/Admin/Api/User
    public function User(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);

        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
               print_r($this->account->getAccountByID($token->ID));
            }
        }
        catch(Exception $e){
            echo $e;
        }
    }
    // url/Admin/Api/EditUser
    public function EditUser(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);

        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                if (json_decode($this->account->updateAccountByID($token->ID,$obj["Name"],$obj["Email"],$obj["Phone"],$obj["Address"]),true)){
                    echo true;
                }
                else{
                    echo false;
                }
            }
        }
        catch(Exception $e){
            echo $e;
        }
    }
    /* ------------------------ Accounts API End ------------------------ */

    /* ------------------------ Favorite API Start ------------------------ */
    // url/Admin/Api/Favorite
    public function Favorite(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $favorite = $this->getModel('FavoriteDAL');
                $favoriteJSON = json_decode($favorite->getFavoriteByUserID($token->ID),true);
                $array = array();
                foreach ($favoriteJSON as $key => $value) {
                    $productJSON = json_decode($this->products->getProductByID($value['ProductID']),true);
                    $array[] = $productJSON;
                }
                print_r(json_encode($array));
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/InsertToFavorite
    public function InsertToFavorite(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                // 1 - Add Successfully
                // 2 - Product Existed
                // 3 - Add Failed
                $favorite = $this->getModel('FavoriteDAL');
                if (!json_decode($favorite->checkExisted($token->ID,$obj['ProductID']),true)){
                    if (json_decode($favorite->insertItem($token->ID,$obj['ProductID']),true)){
                        echo json_encode(1);
                    }
                    else{
                        echo json_encode(3);
                    }
                }
                else{
                    echo json_encode(2);
                }
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/RemoveFavorite
    public function RemoveFavorite(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $favorite = $this->getModel('FavoriteDAL');
                if (json_decode($favorite->removeItem($token->ID,$obj['ProductID']),true)){
                    echo true;
                }
                else{
                    echo false;
                }
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/ClearFavorite
    public function ClearFavorite(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $favorite = $this->getModel('FavoriteDAL');
                if (json_decode($favorite->clearFavorite($token->ID),true)){
                    echo true;
                }
                else{
                    echo false;
                }
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    /* ------------------------ Favorite API End ------------------------ */

    /* ------------------------ Products API Start ------------------------ */
    // url/Admin/Api/Searching
    public function Searching(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $productSearchingJSON;
			if ($obj['IsAdvanced']){
				$priceFrom = str_replace('0.', '0', $obj['PriceFrom']);
				$priceTo = str_replace('0.', '0', $obj['PriceTo']);
				$productSearchingJSON = $this->products->advancedSearch($obj['Key'],$obj['Category'],$priceFrom,$priceTo);
			}
			else{
				$productSearchingJSON = $this->products->basicSearch($obj['Key']);
			}
            print_r($productSearchingJSON);
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/ListProducts
    public function ListProducts(){
        print_r($this->products->getListProduct());
    }
    // url/Admin/Api/Product/$id
    public function Product($productID){
        print_r($this->products->getProductByID($productID));
    }
    // url/Admin/Api/TopView/$number
    public function TopView($number){
        print_r($this->products->getTopView($number));
    }
    // url/Admin/Api/TopHot/$number
    public function TopHot($number){
        print_r($this->products->getTopHot($number));
    }
    // url/Admin/Api/TopNew/$number
    public function TopNew($number){
        print_r($this->products->getTopView($number));
    }
    // url/Admin/Api/Related/$productID
    public function Related($productID){
        $productJSON = json_decode($this->products->getProductByID($productID),true);
        print_r($this->products->getRelatedProductByID($productID,$productJSON['IDCate']));
    }
    // url/Admin/Api/ProductsByCate/$cateID
    public function ProductsByCate($cateID){
        print_r($this->products->getProductByCateID($cateID));
    }
    /* ------------------------ Products API End ------------------------ */

    /* ------------------------ Product Categories API Start ------------------------ */
    // url/Admin/Api/ListCate
    public function ListCate(){
        $categories = $this->getModel('ProductCategoryDAL');
        print_r($categories->getListCate());
    }
    /* ------------------------ Product Categories API End ------------------------ */

    /* ------------------------ Cart API Start ------------------------ */
    // url/Admin/Api/ListCart
    public function ListCart(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $cart = $this->getModel('CartDAL');
                $array = array();
                $array['TotalPrice'] = $cart->getTotalPriceByUserID($token->ID);
                $array['ListCart'] = $cart->getCartByUserID($token->ID);
                print_r(json_encode($array));
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/AddCart
    public function AddCart(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $cart = $this->getModel('CartDAL');
                $productJSON = json_decode($this->products->getProductByID($obj['ProductID']),true);
                if (json_decode($cart->checkExist($token->ID,$obj['ProductID']),true)){ // existed in cart
                    $currentQuantity = json_decode($cart->getCurrentQuantity($token->ID,$obj['ProductID']),true);
                    $newQuantity = $currentQuantity + $obj['Quantity'] > $productJSON['Quantity'] ? $productJSON['Quantity'] : $currentQuantity + $obj['Quantity'];
                    if (json_decode($cart->updateQuantity($token->ID,$obj['ProductID'],$newQuantity,$productJSON['Price']),true)){
                        $array = array();
                        $array['Result'] = true;
                        $array['CountItem'] = json_decode($cart->countCartByUserID($token->ID),true);
                        print_r(json_encode($array));
                    }
                    else{
                        $array = array();
                        $array['Result'] = false;
                        $array['CountItem'] = json_decode($cart->countCartByUserID($token->ID),true);
                        print_r(json_encode($array));
                    }
                }
                else{
                    if (json_decode($cart->addCart($token->ID,$obj['ProductID'],$productJSON['ProductName'],$productJSON['Image'],$obj['Quantity'],$productJSON['Quantity'],$obj['Quantity']*$productJSON['Price']),true)){
                        $array = array();
                        $array['Result'] = true;
                        $array['CountItem'] = json_decode($cart->countCartByUserID($token->ID),true);
                        print_r(json_encode($array));
                    }
                    else{
                        $array = array();
                        $array['Result'] = false;
                        $array['CountItem'] = json_decode($cart->countCartByUserID($token->ID),true);
                        print_r(json_encode($array));
                    }
                }
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/EditQuantityCart
    public function EditQuantityCart(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $cart = $this->getModel('CartDAL');
                $productJSON = json_decode($this->products->getProductByID($obj['ProductID']),true);
                if (json_decode($cart->updateQuantity($token->ID,$obj['ProductID'],$obj['NewQuantity'],$productJSON['Price']),true)){
                    echo true;
                }
                else{
                    echo false;
                }
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/RemoveItem
    public function RemoveItem(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $cart = $this->getModel('CartDAL');
                if (json_decode($cart->removeItem($token->ID,$obj['ProductID']),true)){
                    $array = array();
                    $array['Result'] = true;
                    $array['CountItem'] = json_decode($cart->countCartByUserID($token->ID),true);
                    print_r(json_encode($array));
                }
                else{
                    $array = array();
                    $array['Result'] = true;
                    $array['CountItem'] = json_decode($cart->countCartByUserID($token->ID),true);
                    print_r(json_encode($array));
                }
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/ClearCart
    public function ClearCart(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $cart = $this->getModel('CartDAL');
                if (json_decode($cart->clearCart($token->ID),true)){
                    echo true;
                }
                else{
                    echo false;
                }
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/CountCartItem
    public function CountCartItem(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $cart = $this->getModel('CartDAL');
                echo $cart->countCartByUserID($token->ID);
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/CheckOut
    public function CheckOut(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $cart = $this->getModel('CartDAL');
                $order = $this->getModel('OrderDAL');
                $orderDetail = $this->getModel('OrderDetailDAL');
                $orderID = $order->insertOrder($token->ID,$obj['Name'],$obj['Address'],$obj['Phone'],$obj['Email']);
                if ($orderID > 0){
                    try {
                        $listCartByUser = json_decode($cart->getCartByUserID($token->ID),true);
                        foreach ($listCartByUser as $key => $value) {
                            $productJSON = json_decode($this->products->getProductByID($value['ProductID']),true);
                            if (json_decode($orderDetail->insertOrderDetail($orderID,$value['ProductID'],$value['Quantity'],$productJSON['Price']),true)){
                                $this->products->updateCount($value['ProductID']);
                            }
                        }
                        if (json_decode($cart->clearCart($token->ID),true)){
                            echo true;
                        }
                    } catch (Exeption $e) {
                        echo false;
                    }
                }
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    /* ------------------------ Cart API End ------------------------ */

    /* ------------------------ Order & Order Detail API Start ------------------------ */
    // url/Admin/Api/Purchased
    public function Purchased(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $order = $this->getModel("OrderDAL");
                $orderDetail = $this->getModel("OrderDetailDAL");
                $listOrderJSON = json_decode($order->getOrderByAccountID($token->ID),true);
		        $purchased = array();
		        foreach ($listOrderJSON as $key => $orderItem) {
			        $listOrderDetailJSON = json_decode($orderDetail->getOrderDetailByOrderID($orderItem['ID']),true);
			        foreach ($listOrderDetailJSON as $key => $orderDetailItem) {
				        $productItem = json_decode($this->products->getProductByID($orderDetailItem['ProductID']),true);
                        if (!in_array($productItem,$purchased)){
                            array_push($purchased, $productItem);
                        }
			        }
		        }
                print_r(json_encode($purchased));
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/ListHistory
    public function ListHistory(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $order = $this->getModel('OrderDAL');
                print_r($order->getOrderByAccountID($token->ID));
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/ListOrderDetail
    public function ListOrderDetail(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        $orderDetail = $this->getModel('OrderDetailDAL');
        $listOrderDetailJSON = json_decode($orderDetail->getOrderDetailByOrderID($obj['OrderID']),true); 
        $result = array();
        $listDetail = array();
        $totalPrice = 0;
        foreach ($listOrderDetailJSON as $key => $value) {
            $productJSON = json_decode($this->products->getProductByID($value['ProductID']),true);
            $productItem = array();
            $productItem['ProductID'] = $productJSON['ID'];
            $productItem['ProductName'] = $productJSON['ProductName'];
            $productItem['Image'] = $productJSON['Image'];
            $productItem['Quantity'] = $value['Quantity'];
            $productItem['Price'] = $value['Quantity'] * $value['Price'];
            $totalPrice = $totalPrice + $productItem['Price'];
            $listDetail[] = $productItem;
        }
        $result['ListDetail'] = json_encode($listDetail);
        $result['TotalPrice'] = json_encode($totalPrice);
        print_r(json_encode($result));
    }
    /* ------------------------ Order & Order Detail API End ------------------------ */

    /* ------------------------ Feedback API Start ------------------------ */
    // url/Admin/Api/ListFeedback
    public function ListFeedback(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $contact = $this->getModel('ContactDAL');
		        $result = array();
                $result['ListFeedback'] = $contact->getListSubmitByUserID($token->ID);
                $result['CountUnread'] = json_encode(sizeof(json_decode($contact->getListUnReadUser($token->ID),true)));
                print_r(json_encode($result));
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/SubmitFeedback
    public function SubmitFeedback(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $token = JWT::decode($obj['Token'],'SECRET_KEY',true);
            if ($token->Expire < time()){
                echo "TOKEN has expired";
            }
            else{
                $contact = $this->getModel('ContactDAL');
		        if (json_decode($contact->addFeedback($token->ID,$obj['Name'],$obj['Email'],$obj['Phone'],$obj['Title'],$obj['Content']),true)){
                    echo true;
		        }
                else{
                    echo false;
                }
            }
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    // url/Admin/Api/Feedback
    public function Feedback($feedbackID){
        $contact = $this->getModel('ContactDAL');
        print_r($contact->getFeedbackByID($feedbackID));
    }
    // url/Admin/Api/SendFeedback
    public function SendFeedback(){
        $bodyJSON = file_get_contents('php://input');
        $obj = json_decode($bodyJSON,true);
        
        try{
            $contact = $this->getModel('ContactDAL');
		    $feedbackJSON = json_decode($contact->getFeedbackByID($obj['FeedbackID']),true);
		    $response = $feedbackJSON['Content'].'^'.$obj['Content'];
		    if (json_decode($contact->updateContent($obj['FeedbackID'],$response),true)){
			    if (json_decode($contact->updateResponse($obj['FeedbackID']),true)){
                    echo true;
                }
		    }
		    echo false;
        }
        catch (Exeption $e){
            echo $e;
        }
    }
    /* ------------------------ Feedback API End ------------------------ */
}
?>