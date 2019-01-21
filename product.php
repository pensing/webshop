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
    $name = $row["name"];
    $categorie_id = $row["categorie_id"];
    $description = $row["description"];
    $price = $row["price"];
    $image_filename = $row["image_filename"];
    
    }

    catch(PDOException $e) {
        //echo '<span class="foutmelding">Fout: ' . $sql . "<br>" . mysqli_error($conn) . '</span><br /><br />';
        echo '<span class="foutmelding">Fout: ' . $e->getMessage() . '</span><br /><br />';
    }
    $conn = null;

    if (file_exists('admin/uploads/'.$row["image_filename"])) {
        $fname='admin/uploads/'.$row["image_filename"];
    } else {
        $fname="images/default.jpg";
    }
?>

<div class="container pt-5">
  <div class="row mt-5">
    <div class="col-xs-12 col-sm-6 col-md-8 content-container shadow" style="width: 66%;">
        <img class="" style="width: 100%;" src=" <?php echo $fname; ?>" alt="Product image">
        <h4 class="mt-3 mb-1 text-dark"><?php echo $row["name"]; ?></h4>
        <p><?php echo $row["description"]; ?></p>
        <p><?php echo $row["features"]; ?></p>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4" style="width: 33%; height: 300px;">

<?php
    echo '
    <form method="post" action="shoppingcart.php?id='.$row["id"].'" class="cart-container px-3 py-3 border border-warning rounded shadow">
    <div class="" style="width: 100%; margin: 10px auto">
        <div>
        <h1>'.number_format($row["price"], 0, ',', ' ').',-
            <span style="font-size: 18px; font-weight: bold; font-style: italic; color: white;"> incl. BTW</span></h1>
        </div>
        <div style="width: 100%; height: 50px;">
        <span style="font-size: 14px;">Eigen voorraad: 2</span><br />
        <span style="font-size: 14px;">Voorraad leverancier: 21</span>
        </div>
        <br /><br />
        <div class="form-group" style="width: 100%; height: 100px;">
        <input name="pieces" class="form-control mr-3" style="width: 100px; float: left;" type="number" value=1 min=1>
        <input class="btn btn-warning shadow" type="submit" role="button" value="In winkelwagen" style="width: auto; float: left;">
        </div>
        <div style="width: 100%; height: 50px;">
        <span style="font-size: 14px;">Voor 23:00 besteld, volgende werkdag in huis</span>
        </div>
    </div">
    </form>';
?>
    </div>
  </div>
</div>

    <footer id="" class="site-footer">
    <div class="site-info text-white text-center">Powered by PESS - the easy shop system</div>
    </footer>

</body>
</html>
