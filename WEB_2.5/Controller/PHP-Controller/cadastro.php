<?php
include_once '../../Model/conexao.php';

try {
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = trim($_POST['nome']);
        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);
        $returnUrl = $_GET['return_url'] ?? '/WEB_2.5/View/HTML-View/Index.php';  // Defina um padrão caso `return_url` esteja vazio

        if (empty($nome) || empty($email) || empty($senha)) {
            $_SESSION['mensagem_cadastro'] = "Por favor, preencha todos os campos obrigatórios.";
            header("Location: $returnUrl");
            exit();
        }

        if (strlen($senha) < 8) {
            $_SESSION['mensagem_cadastro'] = "A senha deve ter no mínimo 8 caracteres";
            header("Location: $returnUrl");
            exit();
        }

        $sql = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            $_SESSION['mensagem_cadastro'] = "O email já está cadastrado.";
            header("Location: $returnUrl");
            exit();
        }

        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', password_hash($senha, PASSWORD_DEFAULT));

        if ($stmt->execute()) {
            $_SESSION['mensagem_cadastro'] = "Cadastro realizado com sucesso!";
            header("Location: $returnUrl");
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