<?php 
class Feedback extends ViewModel{
    public function __construct(){
		if (empty($_SESSION['USER_SESSION'])){
			header('Location:'.BASE_URL.'Login/Index');
		}
	}
    public function Index(){
        $contact = $this->getModel('ContactDAL');
        $listFeedbackJSON = json_decode($contact->getListFeedback(),true);
        $this->loadView('Shared','Layout',[
            'title'=>'Feedback',
            'page'=>'Feedback/Index',
            'listFeedback'=>$listFeedbackJSON,
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