<?php

// Acabou não sendo utilizada nem terminada, o código daqui mostraria mensagens instantâneas
// informando certo problema da forma que está sendo inserida uma informação num campo
// ex: nome com @ já mostraria uma mensagem avisando que não é permitido caracteres especiais

session_start();

$mensagens = [
    'mensagem_nome' => '',
    'mensagem_email' => '',
    'mensagem_senha' => '',
    'mensagem_confirmar' => '',
    'mensagem_sucesso' => ''
];

// Captura os dados do formulário ou da sessão
$nome = isset($_POST['nome']) ? trim($_POST['nome']) : (isset($_SESSION['usuario']['nome']) ? $_SESSION['usuario']['nome'] : '');
$email = isset($_POST['email']) ? trim($_POST['email']) : (isset($_SESSION['usuario']['email']) ? $_SESSION['usuario']['email'] : '');
$novaSenha = isset($_POST['nova-senha']) ? trim($_POST['nova-senha']) : '';
$confirmarSenha = isset($_POST['confirmar-senha']) ? trim($_POST['confirmar-senha']) : '';

// Variável para rastrear se houve erros
$erro = false;

// Validação do nome
if (!empty($nome)) {
    if (strlen($nome) < 3) {
        $mensagens['mensagem_nome'] = "O nome deve ter no mínimo 3 caracteres.";
        $erro = true;
    }
} else {
    $mensagens['mensagem_nome'] = "O campo nome é obrigatório.";
    $erro = true;
}

// Validação do email
if (!empty($email)) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagens['mensagem_email'] = "Formato de email inválido.";
        $erro = true;
    }
} else {
    $mensagens['mensagem_email'] = "O campo email é obrigatório.";
    $erro = true;
}

// Validação da nova senha
if (!empty($novaSenha)) {
    if (strlen($novaSenha) < 8) {
        $mensagens['mensagem_senha'] = "A nova senha deve ter no mínimo 8 caracteres.";
        $erro = true;
    }

    if ($novaSenha !== $confirmarSenha) {
        $mensagens['mensagem_confirmar'] = "A confirmação da senha não corresponde.";
        $erro = true;
    }
} elseif (!empty($confirmarSenha)) {
    $mensagens['mensagem_confirmar'] = "O campo nova senha é obrigatório.";
    $erro = true;
}

// Retorna as mensagens em JSON
echo json_encode($mensagens);
exit();
