<?php

namespace Webshop;
use \PDO;

require_once("header.php");

require_once("../src/views.php");
use Webshop\{TableView};

?>

<header>
	<h1 class="page-title mt-5" style="">BERICHTEN</h1>
</header>

<?php

try {
    // Create connection
    $conn = DB();
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo '<span class="melding">Verbinding is gelukt</span><br /><br />';

    $fields = array("id"=>"#", "title"=>"Titel", "create_date"=>"Datum");

    $sql = "SELECT id, title, create_date FROM news";

    //$sql = "SELECT a.id, a.title, b.name as cat, c.name, a.create_date FROM news a 
    //JOIN news_categories b ON a.categorie_id=b.id INNER JOIN news_editors c ON a.editor_id=c.id
    //ORDER BY a.id";
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    //$stmt = $conn->query($sql);
}
catch(PDOException $e) {
    echo foutMelding($e->getMessage());
}

$tv = new TableView();
$tv->showTable($stmt, $fields, "news");

?>


<?php
    //echo printFooter();
    $conn = null;
?>

<?php
require_once("footer.php");
?>
