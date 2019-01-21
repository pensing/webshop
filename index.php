<?php
require_once("header.php");
?>

<div class="container-fluid pt-5 border-bottom border-secondary shadow-lg" style="background-color: #ffffff99;">
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active text-center">
      <img src="admin\uploads\LG-32LK6100.png" class="w-60" alt="...">
    </div>
    <div class="carousel-item text-center">
      <img src="admin\uploads\PHILIPS-50PUS6203-12.png" class="w-60" alt="...">
    </div>
    <div class="carousel-item text-center">
      <img src="admin\uploads\SAMSUNG-UE55NU7100.png" class="w-60" alt="...">
    </div>
  </div>
  <!-- Left and right controls -->
  <a class="carousel-control-prev text-warning" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only text-warning">Previous</span>
  </a>
  <a class="carousel-control-next text-warning" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only text-warning">Next</span>
  </a>
</div>
</div>

<?php

//require "vendor/autoload.php";
require_once("src/database.php");
use Webshop\{Data};
require_once("src/classes.php");
use Webshop\{product};

require_once("admin/functions.php");
//require_once("database.php");

?>

<?php

try {

    $conn = new Data();
    //echo "connected";
    $sql = "SELECT * FROM products WHERE 1 ORDER BY id";

    //$stmt = $conn->connection->prepare($sql); 
    //$stmt = $conn->prepare($sql); 
    //$stmt->execute();
    //$stmt = $conn->query($sql);

    $stmt = $conn->run($sql);
    $stmt->execute();
}
catch(PDOException $e) {
    echo foutMelding($e->getMessage());
}

echo '<div class="container mt-5"><div class="row">';

if ($stmt->rowCount()>0) {
    while($row = $stmt->fetch()) {
    $product = new Product($row);
    echo $product->printProductInfo($row);
    }
} else {
    echo "Geen producten aanwezig";
}

echo '</div></div>';

?>

<footer id="" class="site-footer">
    <div class="site-info text-white text-center">Powered by PESS - the easy shop system</div>
</footer>

</body>
</html>

<?php
//}
?>