<?php
require_once("header.php");
?>

<header>
    <h1 class="page-title mt-5" style="">NIEUW BERICHT</h1>
</header>

<div class="table-container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST["id"];
    $title = $_POST["title"];
    $id_categorie = $_POST["id_categorie"];
    $id_editor = $_POST["id_editor"];
    $tekst = $_POST["tekst"];
    $image_filename = $_POST["image_filename"];

    try {
        // Create connection
        $conn = DB();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
        $statement = $conn->prepare('INSERT INTO news (title, id_categorie, id_editor, tekst, image_filename) VALUES (:title, :id_categorie, :id_editor, :tekst, :image_filename)');
        $statement->execute([
            'title'=>$_POST['title'],
            //'id_categorie'=>$_POST['id_categorie'],
            'id_categorie'=>0,
            'id_editor'=>$_POST['id_editor'],
            'tekst'=>$_POST['tekst'],
            'image_filename'=>$_POST['image_filename']
        ]);

    echo '<span class="melding">Nieuw bericht met succes toegevoegd.</span><br /><br />';
    
    }

    catch(PDOException $e)
    {
        echo foutMelding($e->getMessage());
    }
    
    $conn = null;

    $title = $id_categorie = $id_editor = $tekst = $image_filename = '';        

} else {
    $title = $id_categorie = $id_editor = $tekst = $image_filename = '';
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
    Schrijver:
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
