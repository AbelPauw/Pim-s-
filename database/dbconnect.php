<?php

session_start();

$dsn = "mysql:host=localhost;dbname=pim";
$username = "pim";
$password = 'pim';

try{
$pdo = new PDO($dsn, $username, $password);
}

catch (PDOException $e){
    echo($e->getmessage());
}

?>