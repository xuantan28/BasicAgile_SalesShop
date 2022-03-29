<?php  
class Cart extends ViewModel{
	public function __construct(){
		if (empty($_SESSION['USER_SESSION'])){
			header('Location:'.BASE_URL.'Login/Index');
		}
	}
	public function Index(){
		$this->loadView('Shared','Layout',[
			'title'=>'Cart',
			'page'=>'Cart/Index'
		]);
	}
	public function Payment(){
		$cart = $this->getModel('CartDAL');
		$userCart = json_decode($cart->getCartByUserID($_SESSION['USER_ID_SESSION']),true);
		if (!empty($userCart)){
			$product = $this->getModel('ProductDAL');
			$account = $this->getModel('AccountDAL');
			$order = $this->getModel('OrderDAL');
			$orderDetail = $this->getModel('OrderDetailDAL');
			try {
				$orderID = $order->insertOrder(json_decode($account->getIDByName($_SESSION['USER_SESSION'])),$_POST['shipName'],$_POST['shipAddress'],$_POST['shipPhone'],$_POST['shipEmail']);
				foreach ($userCart as $key => $value) {
					$orderDetail->insertOrderDetail($orderID,$value['ProductID'],$value['Quantity'],$value['Price']);
					$product->updateCount($value['ProductID']);
				}
				$cart->clearCart($_SESSION['USER_ID_SESSION']);
				$this->loadView('Shared','Layout',[
					'title'=>'Success',
					'page'=>'Shared/Success'
				]);
			} catch (Exception $e) {
				$this->loadView('Shared','Layout',[
					'title'=>'Failed',
					'page'=>'Shared/Failed'
				]);
			}
		}
		else{
			header('Location:'.BASE_URL);
		}
	}
}
?>