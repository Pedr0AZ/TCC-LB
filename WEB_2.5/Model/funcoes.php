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

function validarInput($nome, $email, $novaSenha, $confirmarSenha) {
    // Inicializa as mensagens
    $mensagens = [];

    // Validação do nome
    if (empty($nome)) {
        $mensagens['mensagem_nome'] = 'O campo nome não pode ser vazio.';
    } elseif (preg_match('/^[\s]/', $nome)) { 
        $mensagens['mensagem_nome'] = 'O nome não pode começar com espaço ou caracteres invisíveis.';
    } elseif (strlen(trim($nome)) < 3) { 
        $mensagens['mensagem_nome'] = 'O nome deve ter no mínimo 3 caracteres.';
    } elseif (preg_match_all('/[a-zA-Z]/', $nome) < 3) { 
        $mensagens['mensagem_nome'] = 'O nome deve conter pelo menos 3 letras.';
    } elseif (!preg_match('/^[a-zA-Z-_][a-zA-Z0-9-_ ]*$/', $nome)) { 
        $mensagens['mensagem_nome'] = 'O nome contém caracteres inválidos. Use apenas letras, números, hífen, underline ou espaços.';
    }
    
    // Validação do email
    if (empty($email)) {
        $mensagens['mensagem_email'] = 'O campo email não pode ser vazio.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagens['mensagem_email'] = 'O email fornecido é inválido.';
    }

    // Validação da senha
    if (!empty($novaSenha) && strlen($novaSenha) < 8) {
        $mensagens['mensagem_senha'] = 'A senha deve ter no mínimo 8 caracteres.';
    }

    // Validação da confirmação da senha
    if (!empty($novaSenha)) {
        if (empty($confirmarSenha)) {
            $mensagens['mensagem_confirmar'] = 'Por favor, confirme a senha.';
        } elseif ($novaSenha !== $confirmarSenha) {
            $mensagens['mensagem_confirmar'] = 'As senhas não coincidem.';
        }
    }

    // Armazena as mensagens na sessão
    foreach ($mensagens as $key => $msg) {
        $_SESSION[$key] = $msg;
    }

    return $mensagens;
}


?>
