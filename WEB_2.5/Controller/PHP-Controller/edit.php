<?php
session_start();
include '../../Model/conexao.php'; // Inclua a conexão com o banco de dados
include '../../Model/funcoes.php'; // Inclua o arquivo com as funções

// Captura os dados do formulário
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$novaSenha = $_POST['nova-senha'] ?? '';
$confirmarSenha = $_POST['confirmar-senha'] ?? '';

// Valida os dados (função da classe)
$mensagens = validateInput($nome, $email, $novaSenha, $confirmarSenha);

// Se não houver mensagens de erro, atualiza os dados
if (empty($mensagens)) {
    // Atualiza o nome e email na sessão
    $_SESSION['usuario_nome'] = $nome;
    $_SESSION['usuario_email'] = $email;

    // Se a nova senha foi preenchida, atualiza também no banco de dados
    if (!empty($novaSenha)) {
        $hashedSenha = password_hash($novaSenha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $hashedSenha);
        $stmt->bindParam(':id', $_SESSION['usuario_id']); // Presumindo que o ID do usuário está armazenado na sessão
        //^ Nota: o id não é modificado... Verificar se posso excluir

        if ($stmt->execute()) {
            $_SESSION['mensagem_sucesso'] = "Todos os dados foram alterados com sucesso!";
        } else {
            $_SESSION['mensagem_erro'] = "Houve um problema ao atualizar os dados.";
        }
    } else {
        // Apenas atualiza nome e email
        $stmt = $conn->prepare("UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $_SESSION['usuario_id']); // Presumindo que o ID do usuário está armazenado na sessão

        if ($stmt->execute()) {
            $_SESSION['mensagem_sucesso'] = "Todos os dados foram alterados com sucesso!";
        } else {
            $_SESSION['mensagem_erro'] = "Houve um problema ao atualizar os dados.";
        }
    }
} else {
    // Se houver mensagens de erro, armazena na sessão
    foreach ($mensagens as $key => $msg) {
        $_SESSION[$key] = $msg;
    }
}

// Redireciona de volta para a página de edição
header("Location: ../../View/ConfigConta.php");
exit();
?>
