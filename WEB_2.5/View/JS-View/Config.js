document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form'); // Seleciona o formulário

    form.addEventListener('input', function (event) {
        const formData = new FormData(form);

        fetch('../Controller/PHP-Controller/insta_validate.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Atualiza as mensagens de erro na página
            document.getElementById('mensagem_nome').textContent = data.mensagem_nome;
            document.getElementById('mensagem_email').textContent = data.mensagem_email;
            document.getElementById('mensagem_senha').textContent = data.mensagem_senha;
            document.getElementById('mensagem_confirmar').textContent = data.mensagem_confirmar;
            
            // Se a mensagem de sucesso existir, exibe-a
            if (data.mensagem_sucesso) {
                document.getElementById('mensagem_sucesso').textContent = data.mensagem_sucesso;
            } else {
                document.getElementById('mensagem_sucesso').textContent = ''; // Limpa a mensagem de sucesso
            }

            // Lógica para mudar a borda do campo de acordo com o erro/sucesso
            // Exemplo para o campo nome
            const nomeInput = document.getElementById('nome');
            if (data.mensagem_nome) {
                nomeInput.style.borderColor = 'red'; // Erro
            } else if (nomeInput.value) {
                nomeInput.style.borderColor = 'green'; // Sucesso
            } else {
                nomeInput.style.borderColor = ''; // Normal
            }

            // Repetir lógica similar para email, nova-senha e confirmar-senha
        })
        .catch(error => console.error('Erro:', error));
    });
});
