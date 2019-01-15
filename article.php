<?php
require_once("admin/functions.php");
require_once("admin/database.php");
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
    <link rel="stylesheet" href="blog.css" />

    <title>Blog</title>
</head>

<body>

	<header>
    <nav class="navbar navbar-expand-lg justify-content-between navbar-dark bg-primary">
        <ul class="navbar-nav ml-2 mr-5">
        <li class="nav-item active">
          <a class="nav-link" href="admin/login.php">Inloggen</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        </ul>
        <h1 class="page-title mt-0 mb-0" style="text-align:center; color: white; font-family: 'arial'; font-size: 32px;">Paul's Easy Blog System</h1>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Zoek..." aria-label="Search">
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Zoek</button>
        </form>
    </nav>
    </header>
    
    <?php
    $id = $_GET["id"];

    try {
    
        $inlog = inlog();   
    
        $servername = $inlog["servername"];
        $dbname = $inlog["dbname"];
        $username = $inlog["username"];
        $password = $inlog["password"];
            
        // Create connection
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";


    $sql = 'SELECT  * FROM news WHERE id=' . $id;

    $stmt = $conn->query($sql);

    $row = $stmt->fetch();
    // get data of row to update
    $id = $row["id"];
    $title = $row["title"];
    $categorie_id = $row["categorie_id"];
    $editor_id = $row["editor_id"];
    $tekst = $row["tekst"];
    $image = $row["image_filename"];
    
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

    echo '<div class="card" style="width: 60%; margin: 100px auto">
    <img class="card-img-top" src="'.$fname.'" alt="Card image cap">
    <div class="card-body">
    <p class="card-text">'.$row["tekst"].'</p>
    </div>
    </div>';
    ?>

    <footer id="" class="site-footer">
    <div class="site-info text-white text-center">Powered by PEBS - the easy blog system</div>
</footer>

</body>
</html>
