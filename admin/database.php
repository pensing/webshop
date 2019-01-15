<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', 'paulus');
define('DATABASE', 'webshop');

function foutMelding($melding) {
    $code = '<span class="foutmelding">Fout: ' . $melding . '</span><br /><br />';
    return $code;
}

function succesMelding($melding) {
    $code = '<span class="melding">' . $melding . '</span><br /><br />';
    return $code;
}

function DB()
{
    try {
        $db = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD);
        return $db;
    } catch (PDOException $e) {
        //return "Error!: " . $e->getMessage();
        //return foutMelding($e->getMessage());
        //die();
        exit(foutMelding($e->getMessage()));
    }
}

function Login($user_name, $password)
{
    try {
        $db = DB();
        
        $query = $db->prepare("SELECT id, password FROM users WHERE (user_name=:user_name OR email=:user_name)");
        $query->bindParam("user_name", $user_name, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            echo $result->user_name;
            if(password_verify($password, $result->password)) {
                return $result->id;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } catch (PDOException $e) {
        //exit($e->getMessage());
        exit(foutMelding($e->getMessage()));
    }

    $db = null;

}

function userDisplay($user_id)
{
    try {
        $db = DB();
        
        $query = $db->prepare("SELECT id, display_name FROM users WHERE id=:user_id");
        $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result->display_name;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        //exit($e->getMessage());
        exit(foutMelding($e->getMessage()));
    }

    $db = null;

}

?>