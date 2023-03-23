<?php
  require("../php/pizzas.php");

  $db = new database();
  $pizzas = new pizzas($db);

  $pizza_id = $_GET['pizza'];
  $ingredient_id = $_GET['ingredient'];
  $position = $_GET['position'];

?>