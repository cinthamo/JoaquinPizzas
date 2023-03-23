<?php
  require("php/pizzas.php");
  require("php/ingredients.php");

  $db = new database();
  $pizzas = new pizzas($db);
  $ingredients_db = new ingredients($db);

  $pizza_id = $_GET['id'];
  if($pizza_id != null) {
    $pizza_name = $pizzas->pizza_name($pizza_id);
    $pizza_html = $pizza_name;
	$pizza_img = 'edit';
    $ingredients = $pizzas->ingredients($pizza_id);
  } else {
    $pizza_html = "<input class='pizza_input w' type='text' value=''/>";
	$pizza_img = 'done';
	$ingredients = [];
  }

  //print_r($ingredients);
  //if($pizza_name == null) {
   // echo "ad";
  //}
  //print_r($pizza_name);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/main.js"></script>

    <title> Joaquin Pizza's</title>
  </head>

  <body>
    <div class="container main-c">
      <div class="container-title"><h1 class="w"> Joaquin Pizza's </h1></div>

      <div class="container-p" style="flex-direction: column;">

        <div class="container-p-title">
					<h2 id="pizza_name" class="name w"><?= $pizza_html ?></h2>
					<button id="edit_pizza_name" class="small-btn" onclick="editPizzaName(<?= $pizza_id ?>);">
						<img src="images/<?= $pizza_img ?>.png" alt="buttonpng" width="30" height="30"/>
					</button>
        </div>

        <div class="container-p-info w">
					<table>
						<?php 
							$total = 0;
							foreach ($ingredients as $ingredient_row):
								$ingredient = $ingredients_db->get($ingredient_row['ingredient_id']);
								$total = $total + $ingredient->cost_price;
						?>
							<tr id="row-<?= $ingredient->id ?>" class="pizza_info"> 
								<td>
									<button class="small-arrow-btn" type="submit" onclick="upIngredient(<?= $ingredient->id ?>, <?= $pizza_id ?>);">
										<img src="images/up.png" alt="buttonpng" width="30" height="30"/>
									</button>
									<button class="small-arrow-btn" type="submit" onclick="downIngredient(<?= $ingredient->id ?>, <?= $pizza_id ?>);">
										<img src="images/down.png" alt="buttonpng" width="30" height="30"/>
									</button>
								</td>
								<td><?= $ingredient->name ?></td>
								<td><?= $ingredient->cost_price ?></td>
								<td class="center">
									<button class="small-c-btn" type="submit" onclick="deleteIngredient(<?= $ingredient->id ?>, <?= $pizza_id ?>, <?= $ingredient->cost_price ?>);">
										<img src="images/trash.png" alt="buttonpng" width="30" height="30"/>
									</button>
								</td>
							</tr>
						<?php 
							endforeach;
							$total = $total * 1.5;
						?>
							<tr id="new-row">
								<td></td>
								<td><input id="new_ing_name" class="w" type="text" placeholder="Nuevo ingrediente"/></td>
								<td><input id="new_ing_price" class="w" type="text" placeholder="Precio"/></td>
								<td>
									<button class="small-btn" onclick="addIngredient(<?= $pizza_id ?>);">
										<img src="images/done.png" alt="buttonpng" width="30" height="30"/>
									</button>
								</td>
							</tr>
							<tr id="empty"><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
							<tr>
								<td></td>
								<td><label class="total">Total:</label></td>
								<td><span id="total"><?= $total ?></span></td>
								<td></td>
							</tr>
					</table>
        </div>

        <div class="container-p-back">
					<button id="return-btn" class="small-btn" onclick="parent.location='index.php'">
						<img src="images/return.png" alt="buttonpng" width="30" height="30"/>
					</button>
        </div>
        

      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>