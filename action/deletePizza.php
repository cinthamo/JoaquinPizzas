<?php
  require("../php/pizzas.php");

  $db = new database();
  $pizzas = new pizzas($db);

  $pizza_id = $_GET['id'];
  $pizza_id = $pizzas->delete($pizza_id);
?>