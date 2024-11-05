<?php

function validarNome($nome) {
    if (preg_match('/^[\s]/', $nome)) {    // Verifica se o nome começa com um espaço ou caracteres invisíveis
        return false; 
    }

    $nome = trim($nome);
    if (strlen($nome) < 3) {    // Verifica o comprimento mínimo de 3 letras
        return false;
    }

    $countLetters = preg_match_all('/[a-zA-Z]/', $nome);    // Verifica se contém pelo menos 3 letras
    if ($countLetters < 3) {
        return false;
    }

    if (!preg_match('/^[a-zA-Z-_][a-zA-Z0-9-_ ]*$/', $nome)) {        // Verifica se o nome contém apenas letras, números, hífen, underline e espaços
        return false;
    }

    return true;
}

function validateInput($nome, $email, $novaSenha, $confirmarSenha) {
    $mensagens = [];

    // Validação do nome
    if (empty($_POST['nome'])) {
        $mensagens['nome'] = 'O campo nome não pode ser vazio.';
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST['nome'])) {
        $mensagens['nome'] = 'Nome contém caracteres inválidos.';
    }
    
    // Validação do email
    if (empty($_POST['email'])) {
        $mensagens['email'] = 'O campo email não pode ser vazio.';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $mensagens['email'] = 'Email inválido.';
    }
    
    // Validação da senha
    if (empty($_POST['senha'])) {
        $mensagens['senha'] = 'O campo senha não pode ser vazio.';
    } elseif (strlen($_POST['senha']) < 6) {
        $mensagens['senha'] = 'A senha deve ter no mínimo 6 caracteres.';
    }
    
    // Validação da confirmação da senha
    if (empty($_POST['confirmar_senha'])) {
        $mensagens['confirmar'] = 'Por favor, confirme a senha.';
    } elseif ($_POST['senha'] !== $_POST['confirmar_senha']) {
        $mensagens['confirmar'] = 'As senhas não coincidem.';
    }
    
    // Armazenando as mensagens na sessão
    foreach ($mensagens as $key => $msg) {
        $_SESSION[$key] = $msg;
    }
    
    // Redireciona para a página de resultado, ou onde você deseja mostrar as mensagens
    header("Location: resultado.php");
    exit;
}

?>
