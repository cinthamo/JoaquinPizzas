<?php
	include("db.php");

	$db = $conn;
	$tableName = "pizza_ingredients";
	$columns = ['pizza_id', 'ingredient_id'];
	$fetchData = fetch_data($db, $tableName, $columns);

?>