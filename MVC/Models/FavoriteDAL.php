<?php
class FavoriteDAL extends Database{
    public function checkExisted($userID,$productID){
        $query = "SELECT * FROM favorite WHERE UserID = $userID AND ProductID = $productID";
        $result = mysqli_query($this->connectionString,$query);
        return json_encode(mysqli_num_rows($result)>0);
    }
    public function insertItem($userID,$productID){
        $query = "INSERT favorite VALUES (NULL,$userID,$productID,NOW())";
        return json_encode(mysqli_query($this->connectionString,$query));
    }
    public function removeItem($userID,$productID){
        $query = "DELETE FROM favorite WHERE UserID = $userID AND ProductID = $productID";
        return json_encode(mysqli_query($this->connectionString,$query));
    }
    public function clearFavorite($userID){
        $query = "DELETE FROM favorite WHERE UserID = $userID";
        return json_encode(mysqli_query($this->connectionString,$query));
    }
    public function getFavoriteByUserID($userID){
        $query = "SELECT * FROM favorite WHERE UserID = $userID ORDER BY CreatedDay DESC";
        $result = mysqli_query($this->connectionString,$query);
        $array = array();
        while ($rows = mysqli_fetch_assoc($result)){
            $array[] = $rows;
        }
        return json_encode($array);
    }
}
?>