<?php

$stmt = false;

if( isset($_REQUEST['catid']) )
{

   if(!isset($_REQUEST['catid']) )
   {
       die("Invalid category selected !");
   }
   
   $catid = $_REQUEST['catid'];
   //echo "catid is " . $catid . "\n";
   

   $query ="select products.name as item, category.category_name as category , products.description as description from products inner join category where products.catid = category.catid  AND category.catid = " . $catid; 
   
   $host = "localhost";
   $db ="appdb";
   $user ="appuser";
   $pass="appsecret123";
   $charset = 'utf8';
   
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false
    ];
    
    $pdo = null;
    
    try
    {
       $pdo = new PDO($dsn, $user, $pass, $opt); 
       $stmt = $pdo->query($query);
    }
    catch(PDOException $e)
    {
       echo $e->getMessage();
    }
       

}

header('Content-Type: text/html; charset=UTF-8');

?>



<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
<title> Tux Shop</title>
</head>
<body>

  <nav class="navbar navbar-dark navbar-expand-sm bg-dark">
      <div>
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Acceder</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.html">Acerca de nosotros</a>
          </li>
         </ul>
      </div>
    </nav>  
  

  
  <div class="container-fluid">
	<h3> Tux Shop </h3>
        <p class="h5">Tux Loco</p>
        <br>
        <p class="lead">Tienda virtual donde puedes encontrar GifCards, mochilas, bolsos, accesorios, ropa y mucho mas.<br>Mira nuestros procductos con descuento.
        
</p>
        <p>
        Tux loco???
        
</p>
  </div>
  <br>
  
  <div class="container border">
  
   <p class="font-weight-bold">Seleciona uno de nuestos productos.<br>
   <small>Tux Loco</small>
   </p>

<p>
<ul>
<li> <a href="welcome.php?catid=1000">Drinks</a> </li>
<li> <a href="welcome.php?catid=1001">Snacks</a> </li>
<li> <a href="welcome.php?catid=1002">Fruits</a> </li>
<li> <a href="welcome.php?catid=1003">Lunch boxes</a> </li>
</ul>
</p>
  <?php

  if($stmt!== False)
  {
  ?>
  
  <table class="table table-striped">
    <thead>
    <tr>
    <th>Item</th>
    <th>Category</th>
    <th>Description</th>
    </tr>
    </thead>
  <tbody>
   <?php
      while($result = $stmt->fetch())
      {
         echo "<tr>";
         echo "<td>" .$result['item']  . "</td><td>" . $result['category'] . "</td><td>" . $result['description'] . "</td>";
         echo "</tr>\n";
      }
   
   ?>
  
  </tbody>
  </table>
  
  <?php
     }
  ?>  
 </div>     
   
  
</body>
</html>

