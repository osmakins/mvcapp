<?php
declare(strict_types=1);

namespace App\Model;

class dbConnect{
  public $db_params;

  public function __construct(){
    // require the configuration file
    require_once(__DIR__ ."/..config/database.php");
    $this->db_params = $db_params;
  }

  function getConnection(){
		$dbConn = new mysqli($this->db_params['servername'],$this->db_params['username'],$this->db_params['password'],$this->db_params['dbname']);
		if($conn->connect_error){
			die("Connection Faild: ". $conn->connect_error);
		}
		return $dbConn;
	}
}