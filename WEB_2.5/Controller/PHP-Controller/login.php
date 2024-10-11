<?php
session_start();
require '../../Model/conexao.php'; 

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = addslashes($_POST['email'] );
        $senha = addslashes($_POST['senha'] );

        if (empty($email) || empty($senha)) {
            $_SESSION['mensagem_login'] = "Por favor, preencha todos os campos obrigatórios.";
            header('location: ../../View/Index.php');
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
                $_SESSION['mensagem_login'] = "Login realizado com sucesso!";
                $_SESSION['logado'] = true; 
                
                header('location: ../../View/Index.php');
                exit();
            } else {
                $_SESSION['mensagem_login'] = "Senha incorreta, por favor tente novamente";
                header('location: ../../View/Index.php');
                exit();
            }
        } else {
            $_SESSION['mensagem_login'] = "Email não encontrado";
            header('location: ../../View/Index.php');
            exit();
        }
    }
} catch (PDOException $e) {
    $_SESSION['mensagem_login'] = "Erro no login: " . $e->getMessage(); //erro no banco de dados
    header('location: ../../View/Index.php');
    exit();
}

?>