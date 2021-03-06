<?php
require_once("header.php");

//require "vendor/autoload.php";
require_once("src/database.php");
use Webshop\{Data};
use function Webshop\{DB};
require_once("src/classes.php");
use Webshop\{product};

require_once("admin/functions.php");
//require_once("database.php");

?>
    
<?php

$id_klant = $_GET["id"];

try {
    // Create connection
    $conn = DB();
    // set the PDO error mode to exception
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo '<span class="melding">Verbinding is gelukt</span><br /><br />';
    $sql = "SELECT * FROM customers WHERE id=".$id_klant;
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    //$stmt = $conn->query($sql);
}
catch(PDOException $e) {
  echo foutMelding($e->getMessage());
}

$row = $stmt->fetch();

?>

<div class="container mt-5 pt-5">
  <div class="row content-container shadow">
    <div class="col-sm">
      <h3>Klantgegevens</h3>
      Voornaam: *
      <input id="" class="form-control" type="text" value="<?php echo $row["firstname"]; ?>">
      Achternaam: *
      <input id="" class="form-control" type="text" value="<?php echo $row["lastname"]; ?>">
    </div>
    <div class="col-sm">
      <h3>Order</h3>

<?php

    try {
    // Create connection
    $conn = DB();
    // set the PDO error mode to exception
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";

    $sql = "SELECT * FROM shoppingcart s WHERE id_customer=".$id_klant;
    $stmt = $conn->prepare($sql); 
    $stmt->execute();

    }

    catch(PDOException $e) {
        //echo '<span class="foutmelding">Fout: ' . $sql . "<br>" . mysqli_error($conn) . '</span><br /><br />';
        echo '<span class="foutmelding">Fout: ' . $e->getMessage() . '</span><br /><br />';
    }
    $conn = null;

    // if (file_exists('admin/uploads/'.$row["image_filename"])) {
    //     $fname='admin/uploads/'.$row["image_filename"];
    // } else {
    //     $fname="images/default.jpg";
    // }
?>

      <div class="mt-4">
      <table class="table" style="width: 100%; margin: auto;">
        <thead>
          <tr>
            <th scope="col">Product</th>
            <th scope="col">Aantal</th>
            <th scope="col">Prijs</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>

        <?php

      while ($row = $stmt->fetch()) {
          echo '<tr>';
          echo '<td>' . $row["id_product"]. '</td><td>' . $row["pieces"]. '</td><td>' . number_format($row["price"], 2, ',', '.'). '</td>';
          echo '<td><a href="users_del.php?id=' . $row["id"] . '"><i class="fas fa-trash-alt" style="color:black; font-size:16px"></i></a></td>';
          echo '</tr>';
      }

        ?>

      </tbody>
      </table>
      </div>

<?php

      try {
      // Create connection
      $conn = DB();
      // set the PDO error mode to exception
      //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Connected successfully";

      $sql = "SELECT * FROM shoppingcart s WHERE id_customer=".$id_klant;
      $sql = "SELECT FORMAT(SUM(`pieces` * `price`), 2) subtotal FROM shoppingcart WHERE `id_customer` = 1";
      $stmt = $conn->prepare($sql); 
      $stmt->execute();

      }

      catch(PDOException $e) {
          //echo '<span class="foutmelding">Fout: ' . $sql . "<br>" . mysqli_error($conn) . '</span><br /><br />';
          echo '<span class="foutmelding">Fout: ' . $e->getMessage() . '</span><br /><br />';
      }
      $conn = null;

      $row = $stmt->fetch();
      $subtotal = $row["subtotal"];
      $sub = (float)filter_var( $subtotal, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
      $shippingcosts = number_format(6.95, 2, ',', '.');
      $t = $sub + 6.95;
      $totalincl = number_format($t, 2, ',', '.'); // + $shippingcosts;
      $totalexcl = 100 * ($t / 121); // 3.547,93
      $btw = 21 * ($totalexcl / 100); // 745,07

      echo '<hr>';
      echo '<div style="width: 100%;">Subtotaal <span style="float: right;">€ ' . number_format($sub, 2, ',', '.') . '</span></div>';
      echo '<div style="width: 100%;">Verzendkosten <span style="float: right;">€ ' . $shippingcosts . '</span></div>';
      echo '<hr>';
      echo '<div style="width: 100%;">Totaal excl. BTW <span style="float: right;">€' . number_format($totalexcl, 2, ',', '.') . '</span></div>';
      echo '<div style="width: 100%;">BTW <span style="float: right;">€ ' . number_format($btw, 2, ',', '.') . '</span></div>';
      echo '<hr>';
      echo '<div style="width: 100%; font-weight: bold;">Totaal incl. BTW <span style="float: right;">€ ' . $totalincl . '</span></div>';
      
?>
      <div class="text-center">
      <a href="completed.php?id=<?php echo $id_klant; ?>"><button class="btn btn-success shadow mt-5" type="button">Betaal</button></a>
    </div>
    </div>
  </div>
</div>

<?php
    //echo printFooter();
    $conn = null;
?>

</div>

    <footer id="" class="site-footer">
    <div class="site-info text-white text-center">Powered by PESS - the easy shop system</div>
    </footer>

</body>
</html>
