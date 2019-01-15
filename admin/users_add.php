<?php
require_once("header.php");
?>

<header>
    <h1 class="page-title mt-5" style="">NIEUWE GEBRUIKER</h1>
</header>

<div class="table-container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $display_name = $_POST["display_name"];

    try {
        // Create connection
        $conn = DB();
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
    
        //$sql = "INSERT INTO news (title, categorie_id, editor_id, tekst, image) VALUES ('$title', 1, 1, '$tekst', '$image')";
        //$conn->exec($sql); id, login_name, password, email, display_name, register_date, profile_photo
 
        $statement = $conn->prepare('INSERT INTO users (user_name, password, email, display_name) VALUES (:user_name, :password, :email, :display_name)');
        $statement->execute([
            'user_name'=>trim($_POST['user_name']),
            'password'=>password_hash(trim($_POST['password']), PASSWORD_DEFAULT),
            'email'=>$_POST['email'],
            'display_name'=>$_POST['display_name']
        ]);

    //echo '<span class="melding">Nieuwe gebruiker met succes toegevoegd.</span><br /><br />';
    
    }

    catch(PDOException $e)
    {
        echo foutMelding($e->getMessage());
    }
    
    $conn = null;

    $user_name = $password = $email = $display_name = '';

} else {
    $user_name = $password = $email = $display_name = '';
}

//id, user_name, password, email, display_name, register_date, profile_photo
?>

Loginnaam:
<input id="" name="user_name" class="form-control" type="text" value="<?php echo $user_name; ?>">
Paswoord:
<input id="" name="password" class="form-control" type="password" value="<?php echo $password; ?>">
Email:
<input id="" name="email" class="form-control" type="text" value="<?php echo $email; ?>">
Schermnaam:
<input id="" name="display_name" class="form-control" type="text" value="<?php echo $display_name; ?>">

<input class="btn btn-dark" type="submit" value="Opslaan" style="margin-top: 50px;">
    
</form>
</div>

<?php
require_once("footer.php");
 ?>
