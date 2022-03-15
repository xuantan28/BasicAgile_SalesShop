<?php  
class OrderDetailDAL extends Database{
	public function insertOrderDetail($orderID,$productID,$quantity,$price){
		$query = "INSERT orderdetail VALUES ($orderID,$productID,'$quantity','$price')";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function getOrderDetailByOrderID($orderID){
		$query = "SELECT ProductID,Quantity,Price FROM orderdetail WHERE OrderID = $orderID";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function removeDetailOrder($orderID){
		$query = "DELETE FROM orderdetail WHERE OrderID = $orderID";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
}
?>