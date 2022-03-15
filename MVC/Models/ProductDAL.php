<?php  
class ProductDAL extends Database{
	public function updateView($productID){
		$query = "UPDATE product SET View = View + 1 WHERE ID = $productID";
		$result = mysqli_query($this->connectionString,$query);
		return json_encode(mysqli_num_rows($result) > 0);
	}
	public function updateCount($productID){
		$query = "UPDATE product SET Count = Count + 1 WHERE ID = $productID";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function updateQuantity($productID,$amountQuantity){
		$query = "UPDATE product SET Quantity = Quantity + ($amountQuantity) WHERE ID = $productID";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function insertProduct($productName,$cateID,$description='description',$image,$price,$count=0,$quantity,$warranty,$view=0,$discount,$vatFee=0){
		$query = "INSERT product VALUES (NULL,'$productName',$cateID,'description','$image',$price,$count,$quantity,$quantity,$warranty,$view,$discount,$vatFee,NOW(),1)";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function removeProduct($productID){
		$query = "DELETE FROM product WHERE ID = $productID";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function getQuantityByID($productID){
		$query = "SELECT Quantity FROM product WHERE ID = $productID";
		$result = mysqli_query($this->connectionString,$query);
		$rows = mysqli_fetch_assoc($result);
		return json_encode($rows['Quantity']);
	}
	public function editProduct($productID,$productName,$productCate,$description,$image,$price,$oldQuantity,$newQuantity,$warranty,$discount,$vatFee){
		$query = "UPDATE product SET ProductName = '$productName', IDCate = $productCate, Description = '$description', Image = '$image', Quantity = $newQuantity, NewQuantity = NewQuantity + ($newQuantity - $oldQuantity), Warranty = $warranty, Discount = $discount, VATFee = $vatFee WHERE ID = $productID";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function getProduct(){
		$query = "SELECT ID,ProductName,IDCate,Image,Price,Quantity,NewQuantity,Discount FROM product WHERE STATUS = true";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function getProductByCateID($cateID){
		$query = "SELECT * FROM product WHERE IDCate = $cateID";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function getTopHot($number){
		$query = "SELECT ID,ProductName,IDCate,Image,Price,Quantity,NewQuantity,Discount,View,Count FROM product WHERE STATUS = true ORDER BY Count DESC LIMIT $number";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function getProductNameByID($productID){
		$query = "SELECT ProductName FROM product WHERE ID = $productID";
		$result = mysqli_query($this->connectionString,$query);
		$rows = mysqli_fetch_assoc($result);
		return json_encode($rows['ProductName']);
	}
	public function getProductImageByID($productID){
		$query = "SELECT Image FROM product WHERE ID = $productID";
		$result = mysqli_query($this->connectionString,$query);
		$rows = mysqli_fetch_assoc($result);
		return json_encode($rows['Image']);
	}
	public function getTopNew($number){
		$query = "SELECT ID,ProductName,IDCate,Image,Price,Quantity,NewQuantity,Discount,View,Count FROM product WHERE STATUS = true ORDER BY CreatedDay DESC LIMIT $number";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function getTopView($number){
		$query = "SELECT ID,ProductName,IDCate,Image,Price,View,Quantity,NewQuantity,Discount,View,Count FROM product WHERE STATUS = true ORDER BY View DESC LIMIT $number";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function getProductByID($productID){
		$query = "SELECT * FROM product WHERE ID = $productID LIMIT 1";
		$result = mysqli_query($this->connectionString,$query);
		return json_encode(mysqli_fetch_assoc($result));
	}
	public function getRelatedProduct($productCateID){
		$query = "SELECT ID,ProductName,Image,Price,Quantity,NewQuantity,Discount,View,Count FROM product WHERE IDCate = $productCateID";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function getRelatedProductByID($productID,$productCateID){
		$query = "SELECT ID,ProductName,Image,Price,Quantity,NewQuantity,Discount,View,Count FROM product WHERE IDCate = $productCateID AND ID != $productID";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function basicSearch($searchName){
		$query = "SELECT * FROM product WHERE ProductName LIKE '%$searchName%'";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)){
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function advancedSearch($searchName,$category,$priceFrom,$priceTo){
		$query = '';
		if ($category == 0){
			$query = "SELECT * FROM product WHERE ProductName LIKE '%$searchName%' AND Price BETWEEN $priceFrom AND $priceTo";
		}
		else {
			$query = "SELECT * FROM product WHERE ProductName LIKE '%$searchName%' AND IDCate = $category AND Price BETWEEN $priceFrom AND $priceTo";
		}
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)){
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function switchStatus($productID){
		$query = "UPDATE product SET Status = !Status WHERE ID = $productID";
		$result = mysqli_query($this->connectionString,$query);
		return json_encode(mysqli_num_rows($result)>0);
	}
	public function countProduct(){
		$query = "SELECT ID FROM product";
		$result = mysqli_query($this->connectionString,$query);
		$count = 0;
		while ($rows = mysqli_fetch_assoc($result)){
			$count = $count + 1;
		}
		return json_encode($count);
	}

	// join table product & productcategory
	public function getListProduct(){
		$query = "SELECT product.*, productcategory.CateName FROM product JOIN productcategory WHERE product.IDCate = productcategory.ID";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)){
			$array[] = $rows;
		}
		return json_encode($array);
	}
}
?>