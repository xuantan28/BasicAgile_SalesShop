<?php 
class Order extends ViewModel{
    public function __construct(){
        if (empty($_SESSION['USER_SESSION'])){
			header('Location:'.BASE_URL.'Login/Index');
		}
    }
    public function Index(){
        $order = $this->getModel('OrderDAL');
        $listOrderJSON = json_decode($order->getListOrder(),true);
        $this->loadView('Shared','Layout',[
            'title'=>'Order',
            'page'=>'Order/Index',
            'listOrder'=>$listOrderJSON,
            'countUser'=>$_SESSION['COUNT_USERS_SESSION'],
			'countAdmin'=>$_SESSION['COUNT_ADMINS_SESSION'],
			'countProduct'=>$_SESSION['COUNT_PRODUCTS_SESSION'],
			'countContact'=>$_SESSION['COUNT_FEEDBACKS_SESSION'],
			'countUnRead'=>$_SESSION['COUNT_UNREADS_SESSION'],
            'listUnRead'=>$_SESSION['LIST_UNREADS_SESSION']
        ],1);
    }
}
?>