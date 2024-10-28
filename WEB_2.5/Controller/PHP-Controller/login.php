<?php
session_start();
require '../../Model/conexao.php'; 

try {
    if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
        $returnUrl = $_GET['return_url'] ?? '../../View/Index.php';
        $_SESSION['mensagem_login'] = "Não era para você estar aqui...";
        header("Location: $returnUrl");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim(addslashes($_POST['email']));
        $senha = trim(addslashes($_POST['senha']));
        $returnUrl = $_GET['return_url'] ?? '../../View/Index.php'; // Padrão caso `return_url` esteja vazio

        // Verifica se os campos obrigatórios estão preenchidos
        if (empty($email) || empty($senha)) {
            $_SESSION['mensagem_login'] = "Por favor, preencha todos os campos obrigatórios.";
            header("Location: $returnUrl");
            exit();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['mensagem_login'] = "Formato de email inválido.";
            header("Location: $returnUrl");
            exit();
        }

        if ($_SESSION['logado'] === true) {
            $_SESSION['mensagem_login'] = "Não era para você estar aqui.";
            header("Location: $returnUrl");
            exit();
        }
        
        $sql = 'SELECT * FROM usuarios WHERE email = :email';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_email'] = $usuario['email']; 
                $_SESSION['usuario_senha'] = $senha; 
                $_SESSION['senha_hash'] = $usuario['senha'];    
                $_SESSION['mensagem_login'] = "Login realizado com sucesso!";
                $_SESSION['logado'] = true;

                header("Location: $returnUrl");
                exit();
            } else {
                $_SESSION['mensagem_login'] = "Senha incorreta, por favor tente novamente";
                header("Location: $returnUrl");
                exit();
            }
        } else {
            $_SESSION['mensagem_login'] = "Email não encontrado";
            header("Location: $returnUrl");
            exit();
        }
    }
} catch (PDOException $e) {
    $_SESSION['mensagem_login'] = "Erro no login: " . $e->getMessage(); // erro no banco de dados
    header("Location: $returnUrl");
    exit();
}
?>
