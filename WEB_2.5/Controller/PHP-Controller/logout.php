<?php
session_start();
$_SESSION['logado'] = false;
session_destroy(); 
header("Location: ../../View/Index.php"); 
exit;
?>