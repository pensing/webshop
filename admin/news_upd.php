<?php

namespace Webshop;
use \PDO;

require_once("header.php");
?>

<header>
	<h1 class="page-title mt-5" style="">BERICHT WIJZIGEN</h1>
</header>

<div class="table-container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST["id"];
    $title = $_POST["title"];
    //$id_categorie_id = $_POST["id_categorie"];
    $id_categorie = 1;
    $id_editor = $_POST["id_editor"];
    $tekst = $_POST["tekst"];
    //$image_filename = $_POST["image_filename"];
    //$image_filename = $_POST[$file];
    $image_filename = $_FILES["filename"]["name"];
    //echo $image_filename;

    try {
    
        // Create connection
        $conn = DB();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";

        //title, categorie_id, editor_id, tekst, image
        //$sql = "UPDATE news SET title= '$title', categorie_id='$categorie_id', editor_id='$editor_id', tekst='$tekst', image='$image' WHERE id=$id";
        $sql = "UPDATE news SET title=:title, id_categorie=:id_categorie, id_editor=:id_editor, tekst=:tekst, image_filename=:image_filename WHERE id=:id";

        $statement = $conn->prepare($sql);
        $statement->execute([
            'id'=>$_POST['id'],
            'title'=>$_POST['title'],
            //'id_categorie'=>$_POST['id_categorie'],
            'id_categorie'=>1,
            'id_editor'=>$_POST['id_editor'],
            'tekst'=>$_POST['tekst'],
            'image_filename'=>$_POST['image_filename']
        ]);

       echo '<span class="melding">Bericht met succes gewijzigd.</span><br /><br />';

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

    // $sql = 'SELECT a.id, a.title, a.categorie_id, a.editor_id, b.name as cat, c.name, a.tekst, a.image_filename, a.create_date FROM news a 
    // INNER JOIN news_categories b ON a.categorie_id=b.id INNER JOIN news_editors c ON a.editor_id=c.id WHERE a.id=' . $id;
    $sql = 'SELECT id, title, id_categorie, id_editor, tekst, image_filename, create_date FROM news WHERE id=' . $id;

    $stmt = $conn->query($sql);

    $row = $stmt->fetch();
    // get data of row to update
    $id = $row["id"];
    $title = $row["title"];
    $id_categorie = $row["id_categorie"];
    //$categorie = $row["cat"];
    $id_editor = $row["id_editor"];
    //$editor = $row["name"];
    $tekst = $row["tekst"];
    $image_filename = $row["image_filename"];
    
    }

    catch(PDOException $e) {
        echo foutMelding($e->getMessage());
    }

    $conn = null;

}
?>

<div style="width: 100%;">
    <div class="form-group" style="float:left; width: 10%; padding-right: 15px;">
    Id:
    <input id="" name="id" class="form-control" type="text" value="<?php echo $id; ?>" style="width:100%;" readonly>
    </div>
    <div class="form-group" style="float:left; width: 60%; padding-right: 15px;">
    Titel:
    <input id="" name="title" class="form-control" type="text" value="<?php echo $title; ?>">
    </div>
    <div class="form-group" style="float:left; width: 30%; padding-right: 0px;">
    Editor:
    <select name="id_editor" class="form-control">
    <option value="1">Paul</option>
    <option value="2">Paulus</option>
    <option value="3">Gorilla</option>
    </select>
    </div>
    <div class="form-group" style="float:left; width: 100%;">
    <label style="width: 100%; float: left;">Plaatje:</label>
    <input id="" name="image_filename" class="form-control" type="text" value="<?php echo $image_filename; ?>" style="width: 49%; float: left; margin-right: 2%;" readonly>
    <input id="" name="filename" class="form-control" type="file" style="width: 49%; float: left;">
    </div>
</div>
<div style="width: 100%;">
    Tekst:
    <textarea class="form-control" name="tekst" rows="5" cols="120"><?php echo htmlspecialchars($tekst); ?></textarea>

    <input class="btn btn-dark" type="submit" value="Opslaan" style="margin-top: 50px;">
</div>    

</form>
</div>

<?php
require_once("footer.php");
?>
