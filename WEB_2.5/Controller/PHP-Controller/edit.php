<?php
include_once __DIR__ . '/../../Model/conexao.php';
include_once __DIR__ . '/../../Model/funcoes.php';
session_start();

// Inicializar as variáveis de sessão para os novos dados, caso não existam
if (!isset($_SESSION['novo_nome'])) {
    $_SESSION['novo_nome'] = $_SESSION['usuario_nome'];
}
if (!isset($_SESSION['novo_email'])) {
    $_SESSION['novo_email'] = $_SESSION['usuario_email'];
}
if (!isset($_SESSION['novo_senha'])) {
    $_SESSION['novo_senha'] = '';
}
if (!isset($_SESSION['novo_confirmar'])) {
    $_SESSION['novo_confirmar'] = '';
}

$voltarPressed = false;

if (isset($_POST['voltarPressed']) && $_POST['voltarPressed'] === 'true') {
    $voltarPressed = true;
    // Limpar as mensagens de erro da sessão
    unset($_SESSION['mensagem_edit']);
    unset($_SESSION['mensagem_nome']);
    unset($_SESSION['mensagem_email']);
    unset($_SESSION['mensagem_senha']);
    unset($_SESSION['mensagem_confirmar']);

    header('Location: ../../View/ConfigConta.php');
    exit;

} else {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Se valores forem enviados via POST, eles sobrescrevem os valores iniciais, mesmo que estejam vazios
        $nome = isset($_POST['nome']) ? $_POST['nome'] : $_SESSION['novo_nome'];
        $email = isset($_POST['email']) ? $_POST['email'] : $_SESSION['novo_email'];
        $novaSenha = $_POST['nova-senha'] ?? '';
        $confirmarSenha = $_POST['confirmar-senha'] ?? '';

        // Atualiza os valores da sessão para exibição no formulário
        $_SESSION['novo_nome'] = $nome;
        $_SESSION['novo_email'] = $email;
        $_SESSION['novo_senha'] = $novaSenha;
        $_SESSION['novo_confirmar'] = $confirmarSenha;

        // Chama a validação do funcoes.php
        validarInput($nome, $email, $novaSenha, $confirmarSenha);

        // Verifica se existem mensagens de erro antes de prosseguir
        if (
            isset($_SESSION['mensagem_nome']) ||
            isset($_SESSION['mensagem_email']) ||
            isset($_SESSION['mensagem_senha']) ||
            isset($_SESSION['mensagem_confirmar'])
        ) {
            header('Location: ../../View/ConfigConta.php'); // Redireciona para a exibição de mensagens
            exit;
        } else {
            try {
                // Atualiza apenas os campos alterados
                $sql = "UPDATE usuarios SET 
                            nome = IF(:nome != '', :nome, nome), 
                            email = IF(:email != '', :email, email),
                            senha = IF(:novaSenha != '', :novaSenha, senha)
                        WHERE id = :id";

                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':nome', $nome ?: $_SESSION['usuario_nome']);
                $stmt->bindValue(':email', $email ?: $_SESSION['usuario_email']);
                $stmt->bindValue(':novaSenha', $novaSenha ? password_hash($novaSenha, PASSWORD_DEFAULT) : '');
                $stmt->bindValue(':id', $_SESSION['usuario_id']);

                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $_SESSION['usuario_nome'] = $nome ?: $_SESSION['usuario_nome'];
                    $_SESSION['usuario_email'] = $email ?: $_SESSION['usuario_email'];
                    $_SESSION['usuario_senha'] = $novaSenha ?: $_SESSION['usuario_senha'];
                    $_SESSION['novo_senha'] = '';
                    $_SESSION['novo_confirmar'] = '';
                    $_SESSION['mensagem_edit'] = "Dados alterados com sucesso.";
                } else {
                    $_SESSION['mensagem_edit'] = "Nenhuma alteração foi feita.";
                }
            } catch (PDOException $e) {
                $_SESSION['mensagem_edit'] = "Erro ao atualizar os dados: " . $e->getMessage();
            }

            header('Location: ../../View/ConfigConta.php');
            exit;
        }
    }
}
?>
