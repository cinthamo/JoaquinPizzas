<?php
  include("php/pizzas.php");

  $db = new database();
  $pizzas = new pizzas($db);
  $pizzas_list = $pizzas->pizza_list();

  print_r($pizzas_list);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title> Web app test - MCO - Joaquin Inthamoussu</title>
  </head>

  <body>
    <div class="container main-c" style="border: 1px solid red;">
      <div class="container-title" style="border: 1px solid blue;"><h1 class="w"> Web app test </h1></div>

      <div class="container" style="border: 1px solid green;">


      <ul>
        <?php foreach ($pizzas_list as $pizza): ?>
          <li> <?= $pizza ?> </li>
        <?php endforeach; ?>
      </ul>



      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>