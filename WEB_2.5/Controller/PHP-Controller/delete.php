<?php
session_start();
require_once('../../Model/conexao.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario_id']; 
    
    try {
        // Excluir a conta no banco de dados
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $usuario_id, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['mensagem_delete'] = "Conta excluída com sucesso"; 
        
        // Redireciona para ConfigConta com o status de sucesso
        header("Location: ../../View/ConfigConta.php?status=success"); 
        exit(); // Redirecionamento imediato

    } catch (PDOException $e) {
        $_SESSION['mensagem_delete'] = "Erro ao excluir a conta: " . $e->getMessage(); 
        
        // Redireciona para ConfigConta com o status de erro
        header("Location: ../../View/ConfigConta.php?status=error"); 
        exit(); // Redirecionamento imediato
    }
} else {
    $_SESSION['mensagem_delete'] = "Método inválido para exclusão da conta."; 
    header("Location: ../../View/ConfigConta.php?status=invalid"); 
    exit(); // Redirecionamento imediato
}
?>
