<?php 
class Revenue extends ViewModel{
    public function __construct(){
        if (empty($_SESSION['USER_SESSION'])){
			header('Location:'.BASE_URL.'Login/Index');
		}
    }
    public function Index($year){
        $order = $this->getModel('OrderDAL');
        $arrayRevenue = array();
        $arrayRevenuePre = array();
        for ($i = 1; $i <= 12; $i++){
            $revenue = 0;
            $revenuePre = 0;
            $arrayPrice = json_decode($order->listPriceByMonthOfYear($i,$year),true);
            $arrayPricePre = json_decode($order->listPriceByMonthOfYear($i,$year-1),true);
            foreach ($arrayPrice as $item){
                $revenue = $revenue + $item['Price'];
            }
            foreach ($arrayPricePre as $itemPre){
                $revenuePre = $revenuePre + $itemPre['Price'];
            }
            $arrayRevenue[] = $revenue;
            $arrayRevenuePre[] = $revenuePre;
        }
        $this->loadView('Shared','Layout',[
            'title'=>'Revenue',
            'page'=>'Revenue/Index',
            'arrayRevenue'=>$arrayRevenue,
            'arrayRevenuePre'=>$arrayRevenuePre,
            'year'=>$year,
            'sumRevenue'=>array_sum($arrayRevenue),
            'sumRevenuePre'=>array_sum($arrayRevenuePre),
            'minimumRevenue'=>1000000000,
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