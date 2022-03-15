<?php  
class ProductCategoryDAL extends Database{
	public function getListCate(){
		$query = "SELECT * FROM productcategory WHERE STATUS = true ORDER BY DisplayOrder";
		$result = mysqli_query($this->connectionString,$query);
		$array = array();
		while ($rows = mysqli_fetch_assoc($result)) {
			$array[] = $rows;
		}
		return json_encode($array);
	}
	public function getLastIDCate(){
		$query = "SELECT ID FROM productcategory ORDER BY ID desc LIMIT 1";
		$result = mysqli_query($this->connectionString,$query);
		$rows = mysqli_fetch_assoc($result);
		return json_encode($rows['ID']);
	}
	public function insertCategory($cateName, $displayOrder){
		$query = "INSERT productcategory VALUES (NULL, '$cateName', $displayOrder, 1)";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function removeCategory($cateID){
		$query = "DELETE FROM productcategory WHERE ID = $cateID";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function editCategory($cateID, $cateName, $displayOrder){
		$query = "UPDATE productcategory SET CateName = '$cateName', DisplayOrder = $displayOrder WHERE ID = $cateID";
		return json_encode(mysqli_query($this->connectionString,$query));
	}
	public function getIDByCateName($cateName){
		$query = "SELECT ID FROM productcategory WHERE CateName = '$cateName'";
		$result = mysqli_query($this->connectionString,$query);
		$rows = mysqli_fetch_assoc($result);
		return json_encode($rows['ID']);
	}
}
?>