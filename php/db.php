<?php
	class database {
	  private $servername ='localhost';
	  private $username='root';
	  private $password='';
	  private $dbname='pizza_db';
	  private $result=array();
	  private $mysqli;

	  public function __construct() {
	  	$this->mysqli = new mysqli($this->servername,$this->username,$this->password,$this->dbname);
	  }

	  public function insert($table, $para=array()) {
		  $table_columns = implode(',', array_keys($para));
		  $table_value = implode("','", $para);

		  $sql = "INSERT INTO $table($table_columns) VALUES ('$table_value')";

		  return $this->mysqli->query($sql);
	  }

	  public function last($table, $field) {
		$sql = "SELECT $field FROM `$table` ORDER BY $field DESC";

		return $this->mysqli->query($sql)->fetch_row()[0];
	  }

	  public function update($table, $para=array(), $id) {
	    $args = array();

	    foreach ($para as $key => $value) {
	        $args[] = "$key = '$value'"; 
	    }

	    $sql = "UPDATE  $table SET " . implode(',', $args);
	    $sql .= " WHERE $id";

	    return $this->mysqli->query($sql);
	  }

	  public function delete($table, $id) {
	    $sql = "DELETE FROM $table";
	    $sql .= " WHERE $id ";
	    return $this->mysqli->query($sql);
	  }

	  public function select($table, $rows="*", $where = null) {
	    if ($where != null) {
	        $sql = "SELECT $rows FROM `$table` WHERE $where";
	    } else {
	        $sql = "SELECT $rows FROM `$table`;";
	    }
	    return $this->mysqli->query($sql);
	  }

	  public function __destruct() {
	    $this->mysqli->close();
	  }
	}

?>