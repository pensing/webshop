<?php

namespace Webshop;

// Start Session
session_start();

// check user login
if(empty($_SESSION['user_id']))
{
    header("Location: ../index.php");
}

require_once("functions.php");
require_once("../src/database.php");

//get user display_name
$_SESSION["user_display"] = userDisplay($_SESSION['user_id']);

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
    <link rel="stylesheet" href="admin.css" />

	<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea' });</script>

    <title>Webshop</title>
</head>

<body>
<div id="" class="">

	<aside id="sidebar" class="site-sidebar" style="">
		<header class="site-header" style="background-color: #ff0000;">
		<h3 class="menu-subtitle" style="color: white; margin-left: 5px;"><?php echo $_SESSION["user_display"]; ?></h3>
			<nav id="" class="main-navigation">
				<div class="menu-container">
					<a href="logout.php">Uitloggen</a>
					<a href="profile.php">Profiel</a>
				</div>			
			</nav>
			<h3 class="menu-subtitle" style="color: white; margin-left: 5px;">PRODUCTEN</h3>
			<nav id="" class="main-navigation">
				<div class="menu-container">
					<a href="products.php">Alle producten</a>
					<a href="products_add.php">Nieuw product</a>
					<a href="productcategorieen.php">Categorieen</a>
					<a href="cart.php">Winkelmanden</a>
				</div>			
			</nav>
			<h3 class="menu-subtitle" style="color: white; margin-left: 5px;">BERICHTEN</h3>
			<nav id="" class="main-navigation">
				<div class="menu-container">
					<a href="news.php">Alle berichten</a>
					<a href="news_add.php">Nieuw bericht</a>
					<a href="newscategorieen.php">Categorieen</a>
				</div>			
			</nav>
			<h3 class="menu-subtitle" style="color: white; margin-left: 5px;">MEDIA</h3>
			<nav id="" class="main-navigation">
				<div class="menu-container">
					<a href="media.php">Alle bestanden</a>
					<a href="media_upload.php">Bestand uploaden</a>
					<!--a href="mediacategorieen.php">Categorieen</a-->
				</div>			
			</nav>
			<?php
			if (($_SESSION['user_id']==1) AND true) {
			echo '
			<h3 class="menu-subtitle" style="color: white; margin-left: 5px;">GEBRUIKERS</h3>
			<nav id="site-navigation" class="main-navigation">
				<div class="menu-container">
					<a href="users.php">Alle gebruikers</a>
					<a href="users_add.php">Nieuwe gebruiker</a>
				</div>			
			</nav>';}
			?>
		</header>

	</aside>
	<div id="content" class="site-content">
