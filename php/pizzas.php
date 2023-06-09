<?php
	require_once("db.php");

	class pizzas {
		private $db;
		private $table_p = "pizza";
    private $table_p_i = "pizza_ingredients";

		public function __construct($db) {
			$this->db = $db;
		}

    // Get all of the pizzas
		public function pizza_list() {
			return $this->db->select($this->table_p);
		}

    // Get one pizza
		public function pizza_name($id) {
			return $this->db->select($this->table_p, rows: 'name', where: 'id='.$id)->fetch_row()[0];
		}

		public function set_pizza_name($id, $name) {
			if ($id == 0) {
				if ($this->db->insert($this->table_p, para: [ 'name' => $name ])) {
					$id = $this->db->last($this->table_p, 'id');
				}
			}
			else {
				$this->db->update($this->table_p, para: [ 'name' => $name ], id: 'id='.$id);
			}
			return $id;
		}

		public function delete($id) {
			$this->db->delete($this->table_p, 'id='.$id);
		}

    // Get pizza ingredients in id's
    public function ingredients($id) {
      return $this->db->select($this->table_p_i, rows: 'ingredient_id', where: 'pizza_id='.$id);
    }

		public function add_ingredient($pizza_id, $ingredient_id) {
			$position = $this->db->select($this->table_p_i, where: 'pizza_id='.$pizza_id)->num_rows + 1;
			$this->db->insert($this->table_p_i, [ 'pizza_id' => $pizza_id, 'ingredient_id' => $ingredient_id, 'position' => $position ]);
		}

		public function remove_ingredient($pizza_id, $ingredient_id) {
			$this->db->delete($this->table_p_i, 'pizza_id='.$pizza_id.' and ingredient_id='.$ingredient_id);
		}
	}

?>