<?php
require_once("header.php");
?>

<header>
    <h1 class="page-title mt-5" style="text-align:center; color: white; font-family: 'arial'; font-size: 48px;">GEBRUIKER WIJZIGEN</h1>
</header>

<div class="table-container">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST["id"];
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
 
        //checken of het wachtwoord gewijzigd is, indien ja alleen dan updaten (overschrijven)
        if (trim($password)=="") {
            $statement = $conn->prepare('UPDATE users SET user_name=:user_name, email=:email, display_name=:display_name WHERE id=:id');
            $statement->execute([
                'user_name'=>trim($_POST['user_name']),
                'email'=>$_POST['email'],
                'display_name'=>$_POST['display_name'],
                'id'=>$_POST['id']
            ]);
            } else {
            $statement = $conn->prepare('UPDATE users SET user_name=:user_name, password=:password, email=:email, display_name=:display_name WHERE id=:id');
            $statement->execute([
            'user_name'=>trim($_POST['user_name']),
            'password'=>password_hash(trim($_POST['password']), PASSWORD_DEFAULT),
            'email'=>$_POST['email'],
            'display_name'=>$_POST['display_name'],
            'id'=>$_POST['id']
            ]);
        }
    //echo '<span class="melding">Nieuwe gebruiker met succes toegevoegd.</span><br /><br />';
    
    }

    catch(PDOException $e)
    {
        echo foutMelding($e->getMessage());
    }
    
    $conn = null;

    //$user_name = $password = $email = $display_name = '';        

} else {
    //$user_name = $password = $email = $display_name = '';

    $id = $_GET["id"];

    try {
    
    // Create connection
    $conn = DB();
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT * FROM users WHERE id=' . $id;

    //$query = $db->prepare("SELECT id, password FROM users WHERE (user_name=:user_name OR email=:user_name)");
    $query = $conn->prepare($sql);

    $stmt = $conn->query($sql);

    $row = $stmt->fetch();
    // get data of row to update
    //$id = $row["id"];
    $user_name = $row["user_name"];
    $password = $row["password"];
    $email = $row["email"];
    $display_name = $row["display_name"];
    
    }

    catch(PDOException $e) {
        echo foutMelding($e->getMessage());
    }

    $conn = null;


}

//id, login_name, password, email, display_name, register_date, profile_photo
?>

Id:
<input id="" name="id" class="form-control" type="text" value="<?php echo $id; ?>" style="width:100px;" readonly>
Gebruikernaam:
<input id="" name="user_name" class="form-control" type="text" value="<?php echo $user_name; ?>">
Nieuw wachtwoord:
<input id="" name="password" class="form-control" type="password" value="">
Email:
<input id="" name="email" class="form-control" type="text" value="<?php echo $email; ?>">
Schermnaam:
<input id="" name="display_name" class="form-control" type="text" value="<?php echo $display_name; ?>">
<input class="button" type="submit" value="OK" style="margin-top: 50px;">
    
</form>
</div>

<?php
require_once("footer.php");
 ?>
