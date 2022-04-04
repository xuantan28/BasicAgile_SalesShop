<?php  
class Home extends ViewModel{
	public function __construct(){
		if (empty($_SESSION['USER_SESSION'])){
			header('Location:'.BASE_URL.'Login/Index');
		}
		$account = $this->getModel('AccountDAL');
		$product = $this->getModel('ProductDAL');
		$contact = $this->getModel('ContactDAL');
		$_SESSION['COUNT_USERS_SESSION'] = json_decode($account->countAccount(0),true);
		$_SESSION['COUNT_ADMINS_SESSION'] = json_decode($account->countAccount(1),true);
		$_SESSION['COUNT_PRODUCTS_SESSION'] = json_decode($product->countProduct(),true);
		$_SESSION['COUNT_FEEDBACKS_SESSION'] = json_decode($contact->countFeedback(),true);
		$_SESSION['COUNT_UNREADS_SESSION'] = json_decode($contact->countUnRead(),true);
		$_SESSION['LIST_UNREADS_SESSION'] = json_decode($contact->getListUnRead(),true);
	}
	public function Index(){
		$this->loadView('Shared','Layout',[
			'title'=>'Dashboard',
			'page'=>'Home/Index',
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