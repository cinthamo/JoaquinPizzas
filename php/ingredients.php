<?php
	include("db.php");

	$db = $conn;
	$tableName = "ingredients";
	$columns = ['id', 'name', 'cost_price'];
	$fetchData = fetch_data($db, $tableName, $columns);

	function fetch_data($db, $tableName, $columns){
		if(empty($db)){
			$msg= "Database connection error";
		}elseif (empty($columns) || !is_array($columns)) {
			$msg="columns Name must be defined in an indexed array";
		}elseif(empty($tableName)){
			$msg= "Table Name is empty";
	}

?>