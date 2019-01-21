<?php

namespace Webshop;
use \PDO;

require_once("header.php");
?>

<header>
	<h1 class="page-title mt-5" style="">WINKELMANDEN</h1>
</header>

<?php

try {
    // Create connection
    $conn = DB();
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo '<span class="melding">Verbinding is gelukt</span><br /><br />';
    $sql = "SELECT * FROM shoppingcart s ORDER BY id";
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    //$stmt = $conn->query($sql);
}
catch(PDOException $e) {
  echo foutMelding($e->getMessage());
}

?>

<div class="table-container">
<table class="table" style="width: auto; margin: auto;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Klant</th>
      <th scope="col">Produkt</th>
      <th scope="col">Prijs</th>
      <th scope="col">Aantal</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

  <?php

while ($row = $stmt->fetch()) {
    echo '<tr>';
    echo '<td>' . $row["id"]. '</td><td>' . $row["id_customer"]. '</td><td>' . $row["id_product"]. '</td><td>' . $row["price"]. '</td><td>' . $row["pieces"]. '</td>';
    echo '<td><a href="users_upd.php?id=' . $row["id"] . '"><i class="fas fa-pencil-alt" style="color:black; font-size:16px"></i></a></td>';
    echo '<td><a href="users_del.php?id=' . $row["id"] . '"><i class="fas fa-trash-alt" style="color:black; font-size:16px"></i></a></td>';
    echo '</tr>';
}

  ?>

</tbody>
</table>
</div>


<?php
    //echo printFooter();
    $conn = null;
?>

<?php
require_once("footer.php");
?>
