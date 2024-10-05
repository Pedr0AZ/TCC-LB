<?php
include_once '../../Model/conexao.php';

try {
    session_start();

    // Verifica se os dados foram enviados via POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);

        // Validação básica dos dados
        if (empty($nome) || empty($email) || empty($senha)) {
            $_SESSION['mensagem_cadastro'] = "Por favor, preencha todos os campos obrigatórios.";
            header ('location: ../../View/Index.php');
            exit();
        }

        // Verifica se o email já está cadastrado
        $sql = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            $_SESSION['mensagem_cadastro'] = "O email já está cadastrado.";
            header ('location: ../../View/Index.php');
            exit();
        }

        // Insere os dados no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', password_hash($senha, PASSWORD_DEFAULT)); // Use hash para armazenar a senha

        if ($stmt->execute()) {
            $_SESSION['mensagem_cadastro'] = "Cadastro realizado com sucesso!";
            header ('location: ../../View/Index.php');
            exit();
        } else {
            throw new Exception("Erro ao realizar o cadastro.");
        }
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
    exit();
}
?>
