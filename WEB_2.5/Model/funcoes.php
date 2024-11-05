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
    
    if (empty($nome)) {
        $mensagens['erro_nome'] = "O nome não pode estar vazio.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagens['erro_email'] = "Por favor, insira um email válido.";
    }

    if (!empty($novaSenha) || !empty($confirmarSenha)) {
        if (strlen($novaSenha) < 8) {
            $mensagens['erro_senha'] = "A senha deve ter no mínimo 8 caracteres.";
        }

        if ($novaSenha !== $confirmarSenha) {
            $mensagens['erro_confirmar'] = "As senhas não coincidem.";
        }
    }

    return $mensagens;
}

?>
