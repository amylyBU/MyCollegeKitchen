<?php

$host = "127.0.0.1";
$dbname = "mck";
$user = "root";
$pass = "root";

try {
	$db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
}

catch(PDOException $e) {
	echo $e->getMessage();
}

?>