<?php

$host = "localhost";
$user = "root";
$pwd = "";
$name = "chat";

try{
  $con = new PDO("mysql:host=$host;dbname=$name", $user, $pwd);
} catch (PDOException $e){
  echo "SQL Error: ".$e->getMessage();
}