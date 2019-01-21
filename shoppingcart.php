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
    $id = $_GET["id"];
    $pieces = $_POST["pieces"];

    try {
    // Create connection
    $conn = DB();
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";


    $sql = 'SELECT * FROM products WHERE id=' . $id;

    $stmt = $conn->query($sql);

    $row = $stmt->fetch();
    // get data of row to update
    $id = $row["id"];
    $id_customer = $row["id_customer"];
    $categorie_id = $row["categorie_id"];
    $description = $row["description"];
    $price = $row["price"];
    $image_filename = $row["image_filename"];

    $sql = 'INSERT INTO shoppingcart (id_product, id_customer, price, pieces) VALUES (:id_product, :id_customer, :price, :pieces)';
        $statement = $conn->prepare($sql);
        $statement->execute([
            'id_product'=>$id,
            //'id_customer'=>$_POST['id_customer'],
            'id_customer'=>1,
            'price'=>$price,
            'pieces'=>$pieces
        ]);

    $sql = "SELECT * FROM shoppingcart s ORDER BY id";
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    
    }

    catch(PDOException $e) {
        echo '<span class="foutmelding">Fout: ' . $e->getMessage() . '</span><br /><br />';
    }
    $conn = null;

?>

<div class="container pt-5">
    <div class="content-container shadow mx-auto mt-5 pt-5" style="width: fit-content;">
    <div class="">
    <table class="table" style="width: auto; margin: auto;">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Klant</th>
        <th scope="col">Product</th>
        <th scope="col">Aantal</th>
        <th scope="col">Prijs</th>
        <th scope="col"></th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>

    <?php

    while ($row = $stmt->fetch()) {
        echo '<tr>';
        echo '<td>' . $row["id"]. '</td><td>' . $row["id_customer"]. '</td><td>' . $row["id_product"]. '</td><td>' . $row["pieces"]. '</td><td>' . $row["price"]. '</td>';
        echo '<td><a href="users_upd.php?id=' . $row["id"] . '"><i class="fas fa-pencil-alt" style="color:black; font-size:16px"></i></a></td>';
        echo '<td><a href="users_del.php?id=' . $row["id"] . '"><i class="fas fa-trash-alt" style="color:black; font-size:16px"></i></a></td>';
        echo '</tr>';
    }

    ?>

    </tbody>
    </table>
    </div>

    <div class="text-center mt-5">
    <a href="index.php"><button class="btn btn-warning shadow mr-3" type="button">Verder winkelen</button></a>
    <a href="checkout.php?id=1"><button class="btn btn-success shadow" type="button">Afrekenen</button></a>
    </div>

</div>
</div>

<footer id="" class="site-footer">
<div class="site-info text-white text-center">Powered by PESS - the easy shop system</div>
</footer>

</body>
</html>
