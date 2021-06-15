<?php

declare(strict_types=1);

class Model{
	function __construct(){
		echo 'CJ_Model class created <br>';

    // the important part.
    $db = new App\Model\dbConnect();
		$this->connection =  $db->getConnection();
	}

	function create($tableName,$insertWhat){}

	function read($tableName,$args,$whereArgs){}

  function update($tableName,$whatToSet,$whereArgs){}

  function delete($tableName,$whereArgs){}

  function where($sql,$whereArgs){}
}