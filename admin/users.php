<?php

namespace Webshop;
use \PDO;

require_once("header.php");

require_once("../src/views.php");
use Webshop\{TableView};

?>

<header>
	<h1 class="page-title mt-5" style="">GEBRUIKERS</h1>
</header>

<?php

try {
    // Create connection
    $conn = DB();
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo '<span class="melding">Verbinding is gelukt</span><br /><br />';

    $fields = array("id"=>"#", "email"=>"Email", "display_name"=>"Schermnaam", "register_date"=>"Geregistreerd");

    $sql = "SELECT id, user_name, password, email, display_name, register_date FROM users u ORDER BY id";

    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    //$stmt = $conn->query($sql);
}
catch(PDOException $e) {
  echo foutMelding($e->getMessage());
}

$tv = new TableView();
$tv->showTable($stmt, $fields, "users");

?>

<?php
    //echo printFooter();
    $conn = null;
?>

<?php
require_once("footer.php");
?>
