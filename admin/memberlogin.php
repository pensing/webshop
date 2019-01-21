<?php

namespace Webshop {

session_start();
// echo isset($_SESSION['login']);
// if(isset($_SESSION['member_id'])) {
//   header('LOCATION:..\index.php'); die();
// }

//require_once("header.php");
require_once("functions.php");
require_once("..\src\database.php");
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

    <title>Webshop</title>
</head>

<body>

	<header>
		<h1 class="page-title mt-5 mb-5" style="text-align:center; color: red; font-family: 'arial'; font-size: 48px;">Paul's Easy Shop System</h1>
	</header>

  <div id="content" class="inlog-container mx-auto shadow-2 border border-secondary" style="width: fit-content;">
    <div class="mx-auto text-center mb-4">
      <h2 class="text-center" style="color: white; background-color: red; border-radius: 5px; padding: 5px 10px;">Inloggen</h2>
    </div>
    <?php
      if(isset($_POST['submit'])){
        $email = trim($_POST['email']); 
        $password = trim($_POST['password']);


        if ($email == "") {
          $melding = 'Emailadres is verplicht!';
          echo foutMelding($melding);
        } else if ($password == "") {
          $melding = 'Wachtwoord is verplicht!';
          echo foutMelding($melding);
        } else {
          //echo "velden ingevuld";
          $member_id = MemberLogin($email, $password); // check member login
          echo $member_id;
          if($member_id > 0) {
            $_SESSION['member_id'] = $member_id; // Set Session
            header("Location: ..\index.php"); // Redirect user to 
          } else {
              $melding = 'Onjuist emailadres en/of wachtwoord!';
              echo foutMelding($melding);
          }
        }

      }
    ?>

    <div style="width: fit-content;">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="pwd">Paswoord:</label>
        <input type="password" class="form-control" id="pwd" name="password" required>
      </div>
      <div class="text-center">
        <button type="submit" name="submit" class="btn btn-warning mx-auto shadow">Inloggen</button>
      </div>
    </form>
    </div>

</div>
</body>
</html>

<?php } ?>