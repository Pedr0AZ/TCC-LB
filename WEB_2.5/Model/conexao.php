<?php

$server = 'localhost';
$dbname = 'bdtcc';
$username = 'root';
$password = '';

try {
	$pdo = new PDO('mysql:host=localhost;dbname=dbtcc', 'root', '');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
 
?>