<?php

$db_name = "mysql:host=localhost;dbname=shop_db";
$username = "root";
$password = "mysql";

$conn = new PDO($db_name, $username, $password);
if ($conn) {
   # echo 'Connection is successful';
}

?>