<?php 
class User extends ViewModel{
    public function __construct(){
        if (empty($_SESSION['USER_SESSION'])){
			header('Location:'.BASE_URL.'Login/Index');
		}
    }
    public function Index(){
        $account = $this->getModel('AccountDAL');
        $listAccountJSON = json_decode($account->getListAccount(),true);
        $this->loadView('Shared','Layout',[
            'title'=>'Users',
            'page'=>'User/Index',
            'listAccount'=>$listAccountJSON,
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