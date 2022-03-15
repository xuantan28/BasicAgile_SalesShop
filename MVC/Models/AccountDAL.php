<?php  
class AccountDAL extends Database{
	public function checkExist($userName){
		$query = "SELECT * FROM account WHERE UserName = '$userName'";
		$result = mysqli_query($this->connectionString,$query);
		return json_encode(mysqli_num_rows($result)>0);
	}
	public function checkSecretQuestion($userName,$userAnswer){
		$query = "SELECT ID FROM account WHERE UserName = '$userName' AND SecretAnswer = '$userAnswer'";
		$result = mysqli_query($this->connectionString,$query);
		return json_encode(mysqli_num_rows($result)>0);
	}
	public function insertAccount($userName,$passWord,$userAnswer,$type=0){
		$query = "INSERT account VALUES (NULL,'$userName','$passWord',NULL,NULL,NULL,NULL,'What was your childhood name','$userAnswer',NOW(),$type,1)";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function editAccount($userID,$name,$userEmail,$userPhone,$userAddress,$userType){
		$query = "UPDATE account SET Name = '$name', Email = '$userEmail', Phone = '$userPhone', Address = '$userAddress', Type = $userType WHERE ID = $userID";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function removeAccount($userID){
		$query = "DELETE FROM account WHERE ID = $userID";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function resetPassword($userID,$passWord){
		$query = "UPDATE account SET PassWord = '$passWord' WHERE ID = $userID";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function resetForgotPassword($userName,$passWord){
		$query = "UPDATE account SET PassWord = '$passWord' WHERE UserName = '$userName'";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function checkLogin($userName){
		$query = "SELECT PassWord,Status FROM account WHERE UserName = '$userName' LIMIT 1";
		$result = mysqli_query($this->connectionString,$query);
		$rows = mysqli_fetch_assoc($result);
		$PassWord;
		$Status;
		if (isset($rows['PassWord'])){
			$PassWord = $rows['PassWord'];
			$Status = $rows['Status'];
		}
		else{
			$PassWord = '';
			$Status = -1;
		}
		return json_encode(['PassWord'=>$PassWord,'Status'=>$Status]);
	}
	public function getListAccount(){
		$query = "SELECT * FROM account";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)){
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function getTypeByName($userName){
		$query = "SELECT Type FROM account WHERE UserName = '$userName' LIMIT 1";
		$result = mysqli_query($this->connectionString,$query);
		$rows = mysqli_fetch_assoc($result);
		return json_decode(isset($rows['Type'])?$rows['Type']:0);
	}
	public function getIDByName($userName){
		$query = "SELECT ID FROM account WHERE UserName = '$userName' LIMIT 1";
		$result = mysqli_query($this->connectionString,$query);
		$rows = mysqli_fetch_assoc($result);
		return json_decode(isset($rows['ID'])?$rows['ID']:0);
	}
	public function getAccountByName($userName){
		$query = "SELECT * FROM account WHERE UserName = '$userName' LIMIT 1";
		$result = mysqli_query($this->connectionString,$query);
		return json_encode(mysqli_fetch_assoc($result));
	}
	public function getAccountByID($userID){
		$query = "SELECT * FROM account WHERE ID = $userID LIMIT 1";
		$result = mysqli_query($this->connectionString,$query);
		return json_encode(mysqli_fetch_assoc($result));
	}
	public function updateAccount($userName,$name,$email,$phone,$address){
		$query = "UPDATE account SET Name = '$name', Email = '$email', Phone = '$phone', Address = '$address' WHERE UserName = '$userName'";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function updatePassword($userName,$passWord){
		$query = "UPDATE account SET PassWord = '$passWord' WHERE UserName = '$userName'";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function updatePasswordByID($userID,$passWord){
		$query = "UPDATE account SET PassWord = '$passWord' WHERE ID = $userID";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function switchStatus($userID){
		$query = "UPDATE account SET Status = !Status WHERE ID = $userID";
		$result = mysqli_query($this->connectionString,$query);
		return json_encode(mysqli_num_rows($result)>0);
	}
	public function countAccount($type){
		$query = "SELECT ID FROM account WHERE Type = $type";
		$result = mysqli_query($this->connectionString,$query);
		$count = 0;
		while ($rows = mysqli_fetch_assoc($result)){
			$count = $count + 1;
		}
		return json_encode($count);
	}
	public function updateAccountByID($userID,$name,$email,$phone,$address){
		$query = "UPDATE account SET Name = '$name', Email = '$email', Phone = '$phone', Address = '$address' WHERE ID = '$userID'";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
}
?>