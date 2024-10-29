<?php

function validarNome($nome) {
    // Verifica se o nome começa com um espaço ou caracteres invisíveis
    if (preg_match('/^[\s]/', $nome)) {
        return false; 
    }

    // Remove espaços do início e fim e caracteres invisíveis
    $nome = trim($nome);

    // Verifica o comprimento mínimo de 3 letras
    if (strlen($nome) < 3) {
        return false;
    }

    // Verifica se contém pelo menos 3 letras
    $countLetters = preg_match_all('/[a-zA-Z]/', $nome);
    if ($countLetters < 3) {
        return false;
    }

    // Verifica se o nome contém apenas letras, números, hífen, underline e espaços
    if (!preg_match('/^[a-zA-Z][a-zA-Z0-9-_ ]*$/', $nome)) {
        return false;
    }

    return true;
}

?>
