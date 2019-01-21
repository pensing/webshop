<?php

namespace Webshop;
use \PDO;

require_once("header.php");
?>

<header>
	<h1 class="page-title mt-5" style="">GEBRUIKER VERWIJDEREN</h1>
</header>

<div class="table-container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    //onderstaande variabelen niet nodig
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $display_name = $_POST["display_name"];

    try {
    
        // Create connection
        $conn = DB();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // sql to delete a record
        $sql = "DELETE FROM users WHERE id=':id'";

        $statement = $conn->prepare($sql);
        $statement->execute([
            'id'=>$_POST['id']
        ]);
    
        // use exec() because no results are returned
        //$conn->exec($sql);
        echo '<span class="melding">Bericht met succes verwijderd.</span><br /><br />';
    }

    catch(PDOException $e) {
        echo foutMelding($e->getMessage());
    }
    
    $conn = null;

} else {
    $id = $_GET["id"];

    try {
    
        // Create connection
        $conn = DB();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";


        $sql = 'SELECT * FROM users WHERE id=' . $id;

        $stmt = $conn->query($sql);

        $row = $stmt->fetch();
        // get data of row to update
        $id = $row["id"];
        $user_name = $row["user_name"];
        $password = $row["password"];
        $email = $row["email"];
        $display_name = $row["display_name"];
    
    }

    catch(PDOException $e) {
        echo foutMelding($e->getMessage());
    }

    $conn = null;

    echo '
    Id:
    <input id="" name="id" class="form-control" type="text" value="'.$id.'" style="width:50px" readonly>
    Loginnaam:
    <input id="" name="user_name" class="form-control" type="text" value="'.$user_name.'">
    Paswoord:
    <input id="" name="password" class="form-control" type="password" value="">
    Email:
    <input id="" name="email" class="form-control" type="text" value="'.$email.'">
    Schermnaam:
    <input id="" name="display_name" class="form-control" type="text" value="'.$display_name.'">

    <input class="btn btn-dark" type="submit" value="Verwijderen" style="margin-top: 50px;">';
    
}
?>
    
</form>
</div>

<?php
require_once("footer.php");
 ?>
