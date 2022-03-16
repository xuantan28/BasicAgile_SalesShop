<?php 
class ContactDAL extends Database{
    public function addFeedback($userID,$name,$email,$phone,$title,$content){
        $query = "INSERT feedback VALUES (NULL,$userID,'$name','$email','$phone','$title','$content',1,NOW(),0)";
        return json_encode(mysqli_query($this->connectionString,$query));
    }
    public function getListUnRead(){
        $query = "SELECT * FROM feedback WHERE Response = 1 ORDER BY CreatedDay DESC";
        $result = mysqli_query($this->connectionString,$query);
        $array = array();
        while ($rows = mysqli_fetch_assoc($result)){
            $array[] = $rows;
        }
        return json_encode($array);
    }
    public function getListUnReadUser($userID){
        $query = "SELECT * FROM feedback WHERE Response = 0 AND Status = 0 AND UserID = $userID ORDER BY CreatedDay DESC";
        $result = mysqli_query($this->connectionString,$query);
        $array = array();
        while ($rows = mysqli_fetch_assoc($result)){
            $array[] = $rows;
        }
        return json_encode($array);
    }
    public function getListSubmitByUserID($userID){
        $query = "SELECT * FROM feedback WHERE UserID = $userID ORDER BY CreatedDay DESC";
        $result = mysqli_query($this->connectionString,$query);
        $array = array();
        while ($rows = mysqli_fetch_assoc($result)){
            $array[] = $rows;
        }
        return json_encode($array);
    }
    public function getFeedbackByID($feedbackID){
        $query = "SELECT * FROM feedback WHERE ID = $feedbackID";
        $result = mysqli_query($this->connectionString,$query);
        return json_encode(mysqli_fetch_assoc($result));
    }
    public function updateContent($feedbackID,$content){
        $query = "UPDATE feedback SET Content = '$content' WHERE ID = $feedbackID";
        return json_encode(mysqli_query($this->connectionString,$query));
    }
    public function updateResponse($feedbackID){
        $query = "UPDATE feedback SET Response = !Response WHERE ID = $feedbackID";
        return json_encode(mysqli_query($this->connectionString,$query));
    }
    public function switchStatus($feedbackID){
		$query = "UPDATE feedback SET Status = !Status WHERE ID = $feedbackID";
		$result = mysqli_query($this->connectionString,$query);
		return json_encode(mysqli_num_rows($result)>0);
	}
    public function countFeedback(){
		$query = "SELECT ID FROM feedback";
		$result = mysqli_query($this->connectionString,$query);
		$count = 0;
		while ($rows = mysqli_fetch_assoc($result)){
			$count = $count + 1;
		}
		return json_encode($count);
	}
    public function countUnRead(){
        $query = "SELECT ID FROM feedback WHERE Response = 1";
		$result = mysqli_query($this->connectionString,$query);
		$count = 0;
		while ($rows = mysqli_fetch_assoc($result)){
			$count = $count + 1;
		}
		return json_encode($count);
    }

    // join table contact & account
    public function getListFeedback(){
        $query = "SELECT feedback.*,account.UserName FROM feedback JOIN account WHERE feedback.UserID = account.ID ORDER BY CreatedDay DESC";
        $result = mysqli_query($this->connectionString,$query);
        $array = array();
        while ($rows = mysqli_fetch_assoc($result)){
            $array[] = $rows;
        }
        return json_encode($array);
    }
}
?>