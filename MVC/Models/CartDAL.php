<?php
class CartDAL extends Database{
    public function checkExist($userID,$productID){
        $query = "SELECT * FROM cart WHERE UserID = $userID AND ProductID = $productID";
        $result = mysqli_query($this->connectionString,$query);
        return json_encode(mysqli_num_rows($result)>0);
    }
    public function getCurrentQuantity($userID,$productID){
        $query = "SELECT Quantity FROM cart WHERE UserID = $userID AND ProductID = $productID";
        $result = mysqli_query($this->connectionString,$query);
        $row = mysqli_fetch_assoc($result);
        return json_encode($row['Quantity']);
    }
    public function addCart($userID,$productID,$productName,$productImage,$quantity,$maxQuantity,$price){
        $query = "INSERT cart VALUES (NULL,$userID,$productID,'$productName','$productImage',$quantity,$maxQuantity,$price)";
        return json_encode(mysqli_query($this->connectionString,$query));
    }
    public function removeItem($userID,$productID){
        $query = "DELETE FROM cart WHERE UserID = $userID AND ProductID = $productID";
        return json_encode(mysqli_query($this->connectionString,$query));
    }
    public function clearCart($userID){
        $query = "DELETE FROM cart WHERE UserID = $userID";
        return json_encode(mysqli_query($this->connectionString,$query));
    }
    public function updateQuantity($userID,$productID,$newQuantity,$singlePrice){
        $query = "UPDATE cart SET Quantity = $newQuantity, Price = $newQuantity*$singlePrice WHERE UserID = $userID AND ProductID = $productID";
        return json_encode(mysqli_query($this->connectionString,$query));
    }
    public function getCartByUserID($userID){
        $query = "SELECT * FROM cart WHERE UserID = $userID";
        $result = mysqli_query($this->connectionString,$query);
        $array = array();
        while ($rows = mysqli_fetch_assoc($result)){
            $array[] = $rows;
        }
        return json_encode($array);
    }
    public function getTotalPriceByUserID($userID){
        $query = "SELECT SUM(Price) AS TotalPrice FROM cart WHERE UserID = $userID";
        $result = mysqli_query($this->connectionString,$query);
        $row = mysqli_fetch_assoc($result);
        return json_encode($row['TotalPrice']);
    }
    public function countCartByUserID($userID){
        $query = "SELECT COUNT(ID) AS CountItem FROM cart WHERE UserID = $userID";
        $result = mysqli_query($this->connectionString,$query);
        $row = mysqli_fetch_assoc($result);
        return json_encode($row['CountItem']);
    }
}
?>