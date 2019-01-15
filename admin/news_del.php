<?php
require_once("header.php");
?>

<header>
	<h1 class="page-title mt-5" style="">BERICHT VERWIJDEREN</h1>
</header>

<div class="table-container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    //onderstaande variabelen niet nodig
    $title = $_POST["title"];
    $categorie_id = $_POST["categorie_id"];
    $editor_id = $_POST["editor_id"];
    $tekst = $_POST["tekst"];
    $image = $_POST["image"];

    try {
    
        // Create connection
        $conn = DB();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // sql to delete a record
        $sql = "DELETE FROM users WHERE id=:'id'";

        $statement = $conn->prepare($sql);
        $statement->execute([
            'id'=>$_POST['id']
        ]);
    
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


    $sql = 'SELECT  id, title, categorie_id, editor_id, tekst, image FROM news WHERE id=' . $id;

    $stmt = $conn->query($sql);

    $row = $stmt->fetch();
    // get data of row to update
    $id = $row["id"];
    $title = $row["title"];
    $categorie_id = $row["categorie_id"];
    $editor_id = $row["editor_id"];
    $tekst = $row["tekst"];
    $image = $row["image"];
    
    }

    catch(PDOException $e) {
        echo foutMelding($e->getMessage());
    }
    $conn = null;

    echo '
    Id:
    <input id="" name="id" class="form-control" type="text" value="'.$id.'" style="width:50px" readonly>
    Titel:
    <input id="" name="title" class="form-control" type="text" value="'.$title.'">
    Editor:
    <input id="" name="editor_id" class="form-control" type="text" value="'.$editor_id.'">
    Tekst:
    <textarea class="form-control" name="tekst" rows="3" cols="120">'.$tekst.'</textarea>
    Plaatje:
    <input id="" name="image" class="form-control" type="text" value="'.$image.'">

    <input class="btn btn-dark" type="submit" value="Verwijderen" style="margin-top: 50px;">';
    
}
?>
    
</form>
</div>

<?php
require_once("footer.php");
 ?>
