<?php  
class OrderDAL extends Database{
	public function insertOrder($customerID,$customerName,$customerAddress,$customerPhone,$customerEmail){
		$query = "INSERT orders VALUES (NULL,$customerID,'$customerName','$customerPhone','$customerAddress','$customerEmail',NOW(),0)";
		if (mysqli_query($this->connectionString,$query)){
			return json_encode(mysqli_insert_id($this->connectionString));
		}
	}
	public function getOrderByID($orderID){
		$query = "SELECT * FROM orders WHERE ID = $orderID";
		$result = mysqli_query($this->connectionString,$query);
		return json_encode(mysqli_fetch_assoc($result));
	}
	public function getListOrder(){
		$query = "SELECT * FROM orders";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function getOrderByAccountID($accountID){
		$query = "SELECT * FROM orders WHERE CustomerID = $accountID ORDER BY CreatedDay DESC";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function countTotalOrder($accountID){
        $query = "SELECT ID FROM orders WHERE CustomerID = $accountID";
        $result = mysqli_query($this->connectionString,$query);
        return json_encode(mysqli_num_rows($result));
    }
	public function getOrderWithPagination($accountID,$page,$pageSize){
		$skip = ($page-1)*$pageSize;
        $query = "SELECT * FROM orders WHERE CustomerID = $accountID ORDER BY CreatedDay DESC LIMIT $pageSize OFFSET $skip";
        $result = mysqli_query($this->connectionString,$query);
        $array = array();
        while ($rows = mysqli_fetch_assoc($result)){
            $array[] = $rows;
        }
        return json_encode($array);
	}
	public function switchStatus($orderID){
		$query = "UPDATE orders SET Status = !Status WHERE ID = $orderID";
		return (mysqli_query($this->connectionString,$query));
	}
	public function removeOrder($orderID){
		$query = "DELETE FROM orders WHERE ID = $orderID";
		return json_encode(mysqli_query($this->connectionString,$query));
	}

	public function editOrder($orderID,$ordername,$orderEmail,$orderPhone,$orderAddress){
		$query = "UPDATE orders SET CustomerName = '$ordername', CustomerEmail = '$orderEmail', CustomerPhone = '$orderPhone', CustomerAddress = '$orderAddress' WHERE ID = $orderID";
		return json_encode(mysqli_query($this->connectionString,$query));
	}

	// join table order & orderdetail
	public function listPriceByMonthOfYear($month,$year){
		$query = "SELECT orderdetail.Price FROM orders JOIN orderdetail WHERE orders.ID = orderdetail.OrderID AND MONTH(orders.CreatedDay) = $month AND YEAR(orders.CreatedDay) = $year AND orders.Status = 1";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
}
?>