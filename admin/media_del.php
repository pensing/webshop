<?php
require_once("header.php");
?>

<header>
	<h1 class="page-title mt-5" style="text-align:center; color: white; font-family: 'arial'; font-size: 48px;">BESTAND VERWIJDEREN</h1>
</header>

<div class="table-container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $file_name = $_POST["file_name"];

    unlink('uploads/' . $file_name);

    echo succesMelding('uploads/' . $file_name . ' is verwijderd.');

} else {
    $file_name = $_GET["file_name"];

    echo '
    Bestandsnaam:
    <input id="" name="file_name" class="form-control" type="text" value="'.$file_name.'">

    <input class="button" type="submit" value="Verwijderen" style="margin-top: 50px;">';
    
}
?>
    
</form>
</div>

<?php
require_once("footer.php");
 ?>
