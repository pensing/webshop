<?php
// Testing my class definitions

require_once("classes.php");

$p1 = new user("Paul", "Ensing", '21-05-1966');

echo $p1->getFullname();

echo $p1->getAge();

echo $p1->getBirthdate();

echo $p1->fName;
?>

