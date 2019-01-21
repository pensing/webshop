<?php

namespace Webshop {

session_start();
// echo isset($_SESSION['login']);
// if(isset($_SESSION['member_id'])) {
//   header('LOCATION:index.php'); die();
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

  <div id="content" class="inlog-container mx-auto" style="width: fit-content;">
    <div class="mx-auto text-center">
    <h2 class="text-center" style="color: white; background-color: red; border-radius: 5px; padding: 5px 10px;">Registreren</h2>
    </div>
    <?php
      if(isset($_POST['submit'])){
        $email = trim($_POST['email']); 
        $password = trim($_POST['password']);
        $firstname = trim($_POST['firstname']); 
        $lastname = trim($_POST['lastname']); 


        if ($email == "") {
          $melding = 'Email is verplicht!';
          echo foutMelding($melding);
        } else if ($password == "") {
            $melding = 'Wachtwoord is verplicht!';
            echo foutMelding($melding);
        } else if ($firstname == "") {
            $melding = 'Voornaam is verplicht!';
            echo foutMelding($melding);
        } else if ($lastname == "") {
            $melding = 'Achternaam is verplicht!';
            echo foutMelding($melding);
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $melding = 'Ongeldig emailaddres!';
            echo foutMelding($melding);
            } else {
            //echo "velden ingevuld";
            $member_id = Register($email, $password, $firstname, $lastname);
            //echo $member_id;
            if($member_id > 0) {
                $_SESSION['member_id'] = $member_id; // Set Session
                header("Location: ../index.php"); // Redirect user to nieuws.php
            }
        }
      }
    ?>

    <div style="width: 300px; margin: auto;">
    <form action="" method="post">
        <h3 class="mt-4">Persoonlijke gegevens</h3>
        <div class="form-group">
            <label for="salutation">Aanhef:</label>
            <div class="input-group">
            <div class="input-group-text input100 mb-2 mt-1 mr-3">
                <input name="salutation" type="radio" value="PostNL">Mevrouw
            </div>
            <div class="input-group-text input100 mb-2 mt-1">
                <input name="salutation" type="radio" aria-label="DHL">De heer
            </div>
            </div>      
        </div>
        <div class="form-group">
            <label for="firstname">Voornaam:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
        </div>
        <div class="form-group">
            <label for="lastname">Achternaam:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>
        <div class="form-group">
            <label for="postalcode">Postcode:</label>
            <input type="text" class="form-control" id="postalcode" name="postalcode" required>
        </div>
        <div class="form-group">
            <label for="streetnumber">Huisnummer:</label>
            <input type="text" class="form-control" id="streetnumber" name="streetnumber" required>
        </div>
        <div class="form-group">
            <label for="street">Straatnaam:</label>
            <input type="text" class="form-control" id="street" name="street" required>
        </div>
        <div class="form-group">
            <label for="city">Plaats:</label>
            <input type="text" class="form-control" id="city" name="city" required>
        </div>
        <h3>Inloggegevens</h3>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Paswoord:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="text-center">
            <button type="submit" name="submit" class="btn btn-warning mx-auto shadow">Verzenden</button>
        </div>
    </form>
    </div>

</div>
</body>
</html>

<?php } ?>