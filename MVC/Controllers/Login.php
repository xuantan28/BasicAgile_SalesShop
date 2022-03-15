<?php  
class Login extends ViewModel{
	public $accounts;
	function __construct(){
		$this->accounts = $this->getModel('AccountDAL');
	}
	public function Index(){
		$this->loadView('Login','Index',[
			'title'=>'Login/Regis',
		]);
	}
	public function Register(){
		if (isset($_POST['register-btn'])) {
			$userName = $_POST['regis-un'];
			$secretAnswer = $_POST['regis-qs'];
			$passWord = $_POST['regis-ps'];
			$confirmPassword = $_POST['regis-confirmps'];
			if ($passWord != $confirmPassword) {
				$this->loadView('Login','Index',[
					'title'=>'Login/Regis',
					'message' => 'Passwords are not synchronized :D',
					'type' => 'error'
				]);
			}
			else {
				if (json_decode($this->accounts->checkExist($userName))) {
					$this->loadView('Login','Index',[
						'title'=>'Login/Regis',
						'message' => 'This name is already existed :D',
						'type' => 'error'
					]);
				}
				else {
					$passWord = password_hash($passWord, PASSWORD_DEFAULT);
					if (json_decode($this->accounts->insertAccount($userName,$passWord,$secretAnswer))){
						$this->loadView('Login','Index',[
							'title'=>'Login/Regis',
							'message' => 'Register successfully :D',
							'type' => 'success'
						]);
					}
					else{
						$this->loadView('Login','Index',[
							'title'=>'Login/Regis',
							'message' => 'Register failed :D',
							'type' => 'error'
						]);
					}
				}
			}
		}
	}
	public function Login(){
		if (isset($_POST['login-btn'])) {
			$userName = $_POST['login-username'];
			$passWord = $_POST['login-password'];
			$checkLoginJSON = json_decode($this->accounts->checkLogin($userName),true);
			if ($checkLoginJSON['Status']!=-1){
				if ($checkLoginJSON['Status']!=1){
					$this->loadView('Login','Index',[
						'title'=>'Login/Regis',
						'message' => 'This account is not activated :D',
						'type' => 'error'
					]);
				}
				else{
					if (password_verify($passWord,$checkLoginJSON['PassWord'])) {
						$_SESSION['USER_ID_SESSION'] = json_decode($this->accounts->getIDByName($userName),true);
						$_SESSION['USER_SESSION'] = $userName;
						$_SESSION['USER_TYPE_SESSION'] = json_decode($this->accounts->getTypeByName($userName));
						$_SESSION['VISITED_SESSION'] = array();
						if ($_SESSION['USER_TYPE_SESSION']==0){
							header('Location:'.BASE_URL);
						}
						else{
							header('Location:'.ADMIN_BASE_URL);
						}
					}
					else{
						$this->loadView('Login','Index',[
							'title'=>'Login/Regis',
							'message' => 'Username or Passwords is incorrect :D',
							'type' => 'error'
						]);
					}
				}
			}
			else{
				$this->loadView('Login','Index',[
					'title'=>'Login/Regis',
					'message' => 'Username or Passwords is incorrect :D',
					'type' => 'error'
				]);
			}
		}
	}
	public function Logout(){
		session_destroy();
		header('Location:'.BASE_URL.'Login/Index');
	}
}
?>