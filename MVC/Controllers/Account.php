<?php  
class Account extends ViewModel{
	public $account;
	public function __construct(){
		if (empty($_SESSION['USER_SESSION'])){
			header('Location:'.BASE_URL.'Login/Index');
		}
		$this->account = $this->getModel('AccountDAL');
	}
	public function Index(){
		$accountJSON = json_decode($this->account->getAccountByName($_SESSION['USER_SESSION']),true);
		$this->loadView('Shared','Layout',[
			'title'=>'Account',
			'page'=>'Account/Index',
			'account'=>$accountJSON
		]);
	}
	public function UpdatePass(){
		$this->loadView('Shared','Layout',[
			'title'=>'Update Password',
			'page'=>'Account/UpdatePass'
		]);
	}
	public function History($page=1){
		$product = $this->getModel('ProductDAL');
		$order = $this->getModel('OrderDAL');
		$orderDetail = $this->getModel('OrderDetailDAL');

		$pageSize = 4;
		$totalItem = json_decode($order->countTotalOrder($_SESSION['USER_ID_SESSION']),true);
		$totalPage = ceil($totalItem/$pageSize);
		$maxPage = 10;
		$nextPage = $page+1;
		$prevPage = $page-1;

		$listOrderJSON = json_decode($order->getOrderWithPagination($_SESSION['USER_ID_SESSION'],$page,$pageSize),true);
		$history = array();
		foreach ($listOrderJSON as $key => $value) {
			$listOrderDetailJSON = json_decode($orderDetail->getOrderDetailByOrderID($value['ID']),true);
			$totalPrice = 0;
			$products = array();
			foreach ($listOrderDetailJSON as $key => $value1) {
				$totalPrice += $value1['Quantity'] * $value1['Price'];
				array_push($products, [
					'productID'=>$value1['ProductID'],
					'productName'=>json_decode($product->getProductNameByID($value1['ProductID']),true),
					'quantity'=>$value1['Quantity'],
					'price'=>$value1['Price']
				]);
			}
			$historyItem = array(
				'OrderID'=>$value['ID'],
				'Created'=>$value['CreatedDay'],
				'Products'=>$products,
				'TotalPrice'=>$totalPrice,
				'Status'=>$value['Status']
			);
			array_push($history, $historyItem);
		}
		$this->loadView('Shared','Layout',[
			'title'=>'History',
			'page'=>'Account/History',
			'listTransaction'=>$history,
			'totalItem'=>$totalItem,
			'totalPage'=>$totalPage,
			'maxPage'=>$maxPage,
			'nextPage'=>$nextPage,
			'prevPage'=>$prevPage,
			'currentPage'=>$page
		]);
	}
	public function Ordered($orderID){
		$order = $this->getModel('OrderDAL');
        $orderDetail = $this->getModel('OrderDetailDAL');
		$product = $this->getModel('ProductDAL');
        $orderJSON = json_decode($order->getOrderByID($orderID),true);
        $orderDetailJSON = json_decode($orderDetail->getOrderDetailByOrderID($orderID),true);
		
		$listProductOrdered = array();
		$totalPrice = 0;
        foreach ($orderDetailJSON as $item){
            $totalPrice = $totalPrice + ($item['Price']*$item['Quantity']);
			$productItem = array(
				'ProductID'=>$item['ProductID'],
				'ProductImage'=>json_decode($product->getProductImageByID($item['ProductID']),true),
				'ProductName'=>json_decode($product->getProductNameByID($item['ProductID']),true),
				'Quantity'=>$item['Quantity'],
				'Price'=>$item['Price']
			);
			array_push($listProductOrdered, $productItem);
        }
		$this->loadView('Shared','Layout',[
			'title'=>'Ordered',
			'page'=>'Account/Ordered',
			'order'=>$orderJSON,
			'totalPrice'=>$totalPrice,
			'listProductOrdered'=>$listProductOrdered
		]);
	}
	public function Product($type,$page=1){
		$listProducts = array();
		$product = $this->getModel('ProductDAL');
		if ($type == 'Purchased'){
			$order = $this->getModel('OrderDAL');
			$orderDetail = $this->getModel('OrderDetailDAL');
			$listOrderJSON = json_decode($order->getOrderByAccountID($_SESSION['USER_ID_SESSION']),true);
			foreach ($listOrderJSON as $value) {
				$listOrderDetailJSON = json_decode($orderDetail->getOrderDetailByOrderID($value['ID']),true);
				foreach ($listOrderDetailJSON as $key => $value1) {
					$productItem = json_decode($product->getProductByID($value1['ProductID']),true);
					if (!in_array($productItem,$listProducts)){
						array_push($listProducts, $productItem);
					}
				}
			}
		}
		else if ($type == 'Favorite'){
			$favorite = $this->getModel('FavoriteDAL');
			$listFavoriteJSON = json_decode($favorite->getFavoriteByUserID($_SESSION['USER_ID_SESSION']),true);
			foreach ($listFavoriteJSON as $value) {
				$productItem = json_decode($product->getProductByID($value['ProductID']),true);
				array_push($listProducts, $productItem);
			}
		}
		
		$listData = array();
		$pageSize = 6;
		$totalItem = count($listProducts);
		$totalPage = ceil($totalItem/$pageSize);
		$maxPage = 10;
		$nextPage = $page+1;
		$prevPage = $page-1;
		$skip = ($page-1)*$pageSize;
		$take = $skip + $pageSize;
		for ($i=$skip; $i < $take; $i++) { 
			if (!empty($listProducts[$i])){
				array_push($listData, $listProducts[$i]);
			}
		}

		$this->loadView('Shared','Layout',[
			'title'=>$type,
			'page'=>'Account/Product',
			'listProduct'=>$listData,
			'totalItem'=>$totalItem,
			'totalPage'=>$totalPage,
			'maxPage'=>$maxPage,
			'nextPage'=>$nextPage,
			'prevPage'=>$prevPage,
			'currentPage'=>$page
		]);
	}
}
