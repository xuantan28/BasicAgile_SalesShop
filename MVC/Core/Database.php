<?php  
class Database{
	protected $connectionString;
	function __construct(){
		try {
			$this->connectionString = mysqli_connect(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_SERVERNAME);
		} catch (Exception $e) {
			exit($e->getMessage());
		}
		
	}
}
?>