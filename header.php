<?php

namespace Webshop;

session_start();

//get user display_name
if(isset($_SESSION['member_id'])) {
    header('LOCATION:index.php'); die();
    $_SESSION["member_display"] = memberDisplay($_SESSION['member_id']);
    //echo $_SESSION["member_display"];
} else { $_SESSION["member_display"] = ''; }

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
    <!-- link rel="stylesheet" href="admin/admin.css" /-->
    <link rel="stylesheet" href="shop.css" />
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <title>Webshop</title>
</head>

<body>

	<header class="fixed-top">
    <nav class="navbar navbar-dark bg-dark">
        <!--a class="navbar-brand" href="admin/memberlogin.php">Inloggen</a>
        <a class="navbar-brand" href="admin/register.php">Registreren</a-->
        <h1 class="page-title mt-0 mb-0" style="text-align:center; color: white; font-family: 'arial'; font-size: 32px;">WEBSHOP</h1>
        <form class="form-inline">
            <input class="form-control mr-sm-2" type="search" placeholder="Zoek..." aria-label="Search">
            <button class="btn btn-light my-2 my-sm-0 active" type="submit">Zoek</button>
        </form>
        <div>
        <a class="navbar-brand" href="shoppingcart.php"><button id="btnFA" class="btn btn-warning" style="float:right">
            <i class="fas fa-shopping-cart"></i>
			Winkelwagen
        </button></a>
        <?php
        if(isset($_SESSION['member_id'])) {
            echo '
            <a class="navbar-brand" href="admin/memberlogout.php"><button id="" class="btn btn-danger" style="float:right">
            <i class="fas fa-user"></i>
			Uitloggen
            </button></a>';
        } else {
            echo '
            <a class="navbar-brand" href="admin/memberlogin.php"><button id="" class="btn btn-success" style="float:right">
            <i class="fas fa-user"></i>
			Inloggen
            </button></a>';
        }
          
        ?>
        </div>
    </nav>
	</header>
