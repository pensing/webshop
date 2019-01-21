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
      <h3>Status</h3>
        <p>Betaling afgerond<br />Order geplaatst</p>
      <div class="text-center">
      <a href="index.php"><button class="btn btn-success shadow mt-5" type="button">Naar startpagina</button></a>
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
