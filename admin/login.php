<?php
// Start Session
session_start();
    // echo isset($_SESSION['login']);
    // if(isset($_SESSION['login'])) {
    //   header('LOCATION:index.php'); die();
    // }

    //require_once("header.php");
require_once("functions.php");
require_once("database.php");
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

    <title>Blog</title>
</head>

<body>

	<header>
		<h1 class="page-title mt-5" style="text-align:center; color: white; font-family: 'arial'; font-size: 48px;">Paul's Easy Blog</h1>
	</header>

  <div id="content" class="inlog-container">
    <h3 class="text-center">Inloggen</h3>
    <?php
      if(isset($_POST['submit'])){
        $username = trim($_POST['username']); 
        $password = trim($_POST['password']);


        if ($username == "") {
          $login_error_message = 'Username field is required!';
        } else if ($password == "") {
          $login_error_message = 'Password field is required!';
        } else {
          //echo "velden ingevuld";
          $user_id = Login($username, $password); // check user login
          echo $user_id;
          if($user_id > 0) {
            $_SESSION['user_id'] = $user_id; // Set Session
            header("Location: dashboard.php"); // Redirect user to nieuws.php
          } else {
              $login_error_message = 'Invalid login details!';
          }
        }

      }
    ?>

    <div style="width: 300px; margin: auto;">
    <form action="" method="post">
      <div class="form-group">
        <label for="username">Gebruiker:</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="pwd">Paswoord:</label>
        <input type="password" class="form-control" id="pwd" name="password" required>
      </div>
      <button type="submit" name="submit" class="btn btn-success">Inloggen</button>
    </form>
    </div>

</div>
</body>
</html>