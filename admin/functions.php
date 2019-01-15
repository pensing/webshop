<?php

function connect() {
    $servername = "localhost";
    $username = "root";
    $password = "paulus";
    $dbname = "blog";
    
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    /*if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    echo "Connected successfully";*/
    
    return $conn;
    
}

function connect_pdo() {
    $servername = "localhost";
    $username = "root";
    $password = "paulus";
    $dbname = "blog";
    
    // Create connection
    $conn = new PDO("mysql:host=$servername;dbname=blog", $username, $password);
    
    // Check connection
    /*if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    echo "Connected successfully";*/
    
    return $conn;
    
    }
            

?>
