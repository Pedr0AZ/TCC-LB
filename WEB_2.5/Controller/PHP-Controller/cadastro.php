<?php
include_once '../../Model/conexao.php';
include '../../Model/funcoes.php';

try {
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = trim($_POST['email']);
        $senha = trim($_POST['senha']);
        $returnUrl = $_GET['return_url'] ?? '../../View/Index.php';  // Defina um padrão caso `return_url` esteja vazio

        if (empty($nome) || empty($email) || empty($senha)) {
            $_SESSION['mensagem_cadastro'] = "Por favor, preencha todos os campos obrigatórios.";
            header("Location: $returnUrl");
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['mensagem_cadastro'] = "Formato de email inválido.";
            header("Location: $returnUrl");
            exit();
        }

        if (strlen($senha) < 8) {
            $_SESSION['mensagem_cadastro'] = "A senha deve ter no mínimo 8 caracteres.";
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

        if (validarNome($nome)) {
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
        }else {
            $_SESSION['mensagem_cadastro'] = 'Nome Inválido.<br><br>O nome deve conter no mínimo 3 letras, não deve começar com números, espaços em branco nem conter caracteres especiais';
            header("Location: $returnUrl");
            exit();
        }
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
    exit();
}

?>