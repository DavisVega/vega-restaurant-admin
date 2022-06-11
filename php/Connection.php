<?php
class Conecction{

	private $conn;

	public function __construct() {
		try{
			mysqli_report( MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT );
			$con = new mysqli( "localhost", "root", "admin", "vega_restaurant" );
			//$con->set_charset("utf8mb4");
			$this->conn = $con;

		}catch(PDOException $e){
			echo "DataBase error: ".$e->getMessage();
		}
	}

	public function getConnection(){
		return $this->conn;
	}
}

?>