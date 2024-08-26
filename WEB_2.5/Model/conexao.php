<?php

$server = 'localhost';
$dbname = 'bdtcc';
$user = 'root';
$password = '';

try {
	$conn = new PDO("mysql:host=$server;dbname=$dbname", $user, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

    echo "Conexão estabelecida com sucesso!";

} catch(PDOException $e) {
    die("Erro: " . $e->getMessage());
}
 
?>