<?php
include_once '../../Model/conexao.php';

//Ver o código com o ChatGPT dps
//O vídeo q eu estava vendo em sala: https://youtu.be/GX7eWpBSHzs
//fazer um campo no banco de dados que detecta se o usuário está ativo ou não
//dar a opção dele ir para o menu de atividades assim que logar

try {
    session_start();

    // Verifica se os dados foram enviados via POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = addslashes($_POST['email']);
        $senha =  addslashes($_POST['senha']);

        // Validação básica dos dados
        if (empty($nome) || empty($email) || empty($senha)) {
            $_SESSION['mensagem_login'] = "Por favor, preencha todos os campos obrigatórios.";
            header ('location: ../../View/Index.php');
            exit();
        }

        if (strlen($senha) < 8) {
            $_SESSION['mensagem_login'] = "A senha deve ter no mínimo 8 caracteres";
            header ('location: ../../View/Index.php');
            exit();
        }

        // Verifica se o email já está cadastrado
        $sql = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->fetchColumn() > 0) {
            $_SESSION['mensagem_login'] = "O email já está cadastrado.";
            header ('location: ../../View/Index.php');
            exit();
        }

        //escrever o comando pra dar acesso à conta?

        if ($stmt->execute()) {
            $_SESSION['mensagem_login'] = "Login realizado com sucesso!";
            header ('location: ../../View/Index.php');
            exit();
        } else {
            throw new Exception("Erro ao realizar o login.");
        }
    }
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
    exit();
}
?>

?>