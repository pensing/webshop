<?php
require_once("header.php");
?>

<header>
    <h1 class="page-title mt-5" style="">NIEUW PRODUCT</h1>
</header>

<div class="table-container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST["name"];
    $description = $_POST["description"];
    $categorie_id = $_POST["categorie_id"];
    $sku = $_POST["sku"];
    $price = $_POST["price"];
    $features = $_POST["features"];
    $options = $_POST["options"];

    try {
        // Create connection
        $conn = DB();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
        $sql = 'INSERT INTO products (name, description, categorie_id, sku, price, features, options) VALUES (:name, :description, :categorie_id, :sku, :price, :features, :options)';
        $statement = $conn->prepare($sql);
        $statement->execute([
            'name'=>$_POST['name'],
            'description'=>$_POST['description'],
            'categorie_id'=>$_POST['categorie_id'],
            'sku'=>$_POST['sku'],
            'price'=>$_POST['price'],
            'features'=>$_POST['features'],
            'options'=>$_POST['options']
        ]);

    //echo '<span class="melding">Nieuwe gebruiker met succes toegevoegd.</span><br /><br />';
    
    }

    catch(PDOException $e)
    {
        echo foutMelding($e->getMessage());
    }
    
    $conn = null;

    $name = $description = $categorie_id = $sku = $price = $features = $options = '';

} else {
    $name = $description = $categorie_id = $sku = $price = $features = $options = '';
}

?>

Naam:
<input id="" name="name" class="form-control" type="text" value="<?php echo $name; ?>">
Omschrijving:
<input id="" name="description" class="form-control" type="password" value="<?php echo $description; ?>">
Categorie_id:
<input id="" name="categorie_id" class="form-control" type="text" value="<?php echo $categorie_id; ?>">
SKU:
<input id="" name="sku" class="form-control" type="text" value="<?php echo $sku; ?>">
Prijs:
<input id="" name="price" class="form-control" type="text" value="<?php echo $price; ?>">
Kenmerken:
<input id="" name="features" class="form-control" type="text" value="<?php echo $features; ?>">
Opties:
<input id="" name="options" class="form-control" type="text" value="<?php echo $options; ?>">

<input class="btn btn-dark" type="submit" value="Opslaan" style="margin-top: 50px;">
    
</form>
</div>

<?php
require_once("footer.php");
 ?>
