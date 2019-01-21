<?php

namespace Webshop;
use \PDO;

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', 'paulus');
define('DATABASE', 'webshop');

function InstalledDrivers() {
    //print_r(PDO::getAvailableDrivers());
    return PDO::getAvailableDrivers();
}


Class Connection {
 
    //private $server = "mysql:host=localhost;dbname=webshop";
    private $server = "localhost";

    private $database = "webshop";
     
    private $user = "root";
     
    private $pw = "paulus";

    // always disable emulated prepared statement when using the MySQL driver
    // setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
     
    private $attributes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,PDO::ATTR_EMULATE_PREPARES => false,);
     
    protected $con;
     
    public function openConnection()

    {

    try

        {

            $this->con = new PDO('mysql:host='.$this->server.';dbname='.$this->database, $this->user,$this->pw,$this->attributes);

            return $this->con;

        }

    catch (PDOException $e)

        {

            echo "There is some problem in connection: " . $e->getMessage();

        }

    }
     
    public function closeConnection() {
     
           $this->con = null;
     
        }
     
    }
     
class Data {
    public $connection = null;
    public $statement = null;

    function __construct() {
        $this->connection = new PDO('mysql:host=localhost;dbname=webshop', 'root', 'paulus');
        //$this->connection = new PDO('mysql:host='.HOST.';dbname='.DATABASE.'', USER, PASSWORD);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "connected";
        return $this->connection;
    }
    public function run($sql) {
        $this->statement = $this->connection->prepare($sql);
        //$this->statement::exec();
        return $this->statement;
    }
    function __destruct() {
        $this->connection = null;
    }
}

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
        // set the PDO error mode to exception
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        //return "Error!: " . $e->getMessage();
        //return foutMelding($e->getMessage());
        //die();
        exit(foutMelding($e->getMessage()));
    }
}

function MemberLogin($user_name, $password)
{
    try {
        $db = DB();
        
        $query = $db->prepare("SELECT id, password FROM customers WHERE (email=:user_name)");
        $query->bindParam("user_name", $user_name, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            //echo $result->user_name;
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

function Login($user_name, $password)
{
    try {
        $db = DB();
        
        $query = $db->prepare("SELECT id, password FROM users WHERE (user_name=:user_name OR email=:user_name)");
        $query->bindParam("user_name", $user_name, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            //echo $result->user_name;
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

function Register($email, $password, $firstname, $lastname)
{
    try {
        $db = DB();
        $query = $db->prepare("INSERT INTO customers(email, password, firstname, lastname) VALUES (:email,:password,:firstname,:lastname)");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        
        $enc_password = password_hash($password, PASSWORD_DEFAULT);
        $query->bindParam("password", $enc_password, PDO::PARAM_STR);

        $query->bindParam("firstname", $firstname, PDO::PARAM_STR);
        $query->bindParam("lastname", $lastname, PDO::PARAM_STR);
        $query->execute();
        return $db->lastInsertId();
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
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

function memberDisplay($member_id)
{
    try {
        $db = DB();
        
        $query = $db->prepare("SELECT id, firstname, lastname FROM customers WHERE id=:member_id");
        $query->bindParam("member_id", $member_id, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result->firstname.' '.$result->lastname;
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