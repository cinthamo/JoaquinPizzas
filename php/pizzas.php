<?php
	include("db.php");

	class pizzas {
		private $db;
		private $table = "pizza";

		public function __construct($db) {
      $this->db = $db;
    }

    public function pizza_list() {
  		return $this->db->select($this->table);
    }

	}

?>