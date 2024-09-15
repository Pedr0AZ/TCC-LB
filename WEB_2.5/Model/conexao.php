<?php

$server = 'localhost';
$dbname = 'bdtcc';
$username = 'root';
$password = '';

try {
	$conn = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
 
?>