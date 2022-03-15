<?php 
class Contact extends ViewModel{
    public function Index(){
        $this->loadView('Shared','Layout',[
            'title'=>'Contact',
            'page'=>'Contact/Index'
        ]);
    }
    public function History(){
        if (empty($_SESSION['USER_SESSION'])){
			header('Location:'.BASE_URL.'Login/Index');
		}
        $contact = $this->getModel('ContactDAL');
        $listFeedbackJSON = json_decode($contact->getListSubmitByUserID($_SESSION['USER_ID_SESSION']),true);
        $this->loadView('Shared','Layout',[
            'title'=>'History',
            'page'=>'Contact/History',
            'listFeedback'=>$listFeedbackJSON
        ]);
    }
}
?>