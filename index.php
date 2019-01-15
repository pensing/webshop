<?php
require_once("admin/functions.php");
require_once("admin/database.php");
require_once("admin/classes.php");
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!--meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <!-- Extra CSS -->
    <link rel="stylesheet" href="admin/admin.css" />
    <link rel="stylesheet" href="shop.css" />

    <title>Webshop</title>
</head>

<body>

	<header>
    <nav class="navbar navbar-dark bg-dark justify-content-between">
        <a class="navbar-brand" href="admin/login.php">Inloggen</a>
        <h1 class="page-title mt-0 mb-0" style="text-align:center; color: white; font-family: 'arial'; font-size: 32px;">WEBSHOP</h1>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Zoek..." aria-label="Search">
            <button class="btn btn-light my-2 my-sm-0 active" type="submit">Zoek</button>
        </form>
    </nav>
	</header>

<?php

try {

    // Create connection
    $conn = DB();
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM products WHERE 1 ORDER BY id";
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
    //$stmt = $conn->query($sql);
}
catch(PDOException $e) {
    echo foutMelding($e->getMessage());
}

echo '<ul class="list-unstyled">';

if ($stmt->rowCount()>0) {
    // output data of each row
    while($row = $stmt->fetch()) {
    // output data of each row
    //print_r($row);

    $product = new Product($row);
    echo $product->printProductInfo($row);

    }
} else {
    echo "Geen producten aanwezig";
}

echo '</ul>';


?>

<?php
    $conn = null;
?>

<footer id="" class="site-footer">
    <div class="site-info text-white text-center">Powered by PESS - the easy shop system</div>
</footer>

</body>
</html>
