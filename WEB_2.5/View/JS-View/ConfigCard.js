document.addEventListener("DOMContentLoaded", function () {
    const configOverlay = document.getElementById("config-overlay");
    const deleteLink = document.getElementById("deletar-link");
    const cancelBtn = document.getElementById("cancel-btn");
    const deleteBtn = document.getElementById("delete-btn");

    let isCardOpen = false;

    // Lógica do card de excluir conta
    const urlParams = new URLSearchParams(window.location.search);
    const accountDeleted = urlParams.get('status'); 

    // Se a conta foi excluída com sucesso, fechar o card após 4 segundos
    if (accountDeleted === "success") {
        sessionStorage.setItem("cardState", "open");
        configOverlay.classList.remove("hidden");
        isCardOpen = true;
        setTimeout(function () {
            configOverlay.classList.add("hidden"); // Esconder o card após 4 segundos
            sessionStorage.setItem("cardState", "closed");
            isCardOpen = false;
        }, 4000); // Atraso de 4 segundos
    }

    // Restaurar o estado do card ao carregar a página com base no sessionStorage
    if (sessionStorage.getItem("cardState") === "open") {
        configOverlay.classList.remove("hidden");
        isCardOpen = true;
    } else {
        configOverlay.classList.add("hidden");
        isCardOpen = false;
    }

    // Mostrar o card de exclusão ao clicar no link
    if (deleteLink) {
        deleteLink.addEventListener("click", function (event) {
            event.preventDefault(); // Previne redirecionamento
            configOverlay.classList.remove("hidden");
            sessionStorage.setItem("cardState", "open");
            isCardOpen = true;
        });
    }

    // Fechar o card ao clicar no botão "Cancelar"
    if (cancelBtn) {
        cancelBtn.addEventListener("click", function () {
            configOverlay.classList.add("hidden");
            sessionStorage.setItem("cardState", "closed");
            isCardOpen = false;
        });
    }

    // Fechar o card ao clicar fora dele
    if (configOverlay) {
        configOverlay.addEventListener("click", function (event) {
            if (event.target === configOverlay) {
                configOverlay.classList.add("hidden");
                sessionStorage.setItem("cardState", "closed");
                isCardOpen = false;
            }
        });
    }

    // Manter o card aberto após clicar no botão "Excluir"
    if (deleteBtn) {
        deleteBtn.addEventListener("click", function () {
            sessionStorage.setItem("cardState", "open");
            isCardOpen = true;
        });
    }

    // Lógica dos botões do new-passwd >>
    const cancelButton = document.getElementById('cancel-data');
    const saveButton = document.getElementById('save-data');
    const voltarButton = document.getElementById('voltar');
    const newPasswdDiv = document.getElementById('new-passwd');
    const optionsDiv = document.getElementById('options');
    const editSucesso = document.getElementById('edit-sucesso');
    

    if (editSucesso) {
        cancelButton.classList.add('hidden');
        saveButton.classList.add('hidden');
        voltarButton.classList.remove('hidden');
    }

    if (editSucesso === null) {
        newPasswdDiv.classList.add("hidden");
        optionsDiv.classList.remove("hidden");
    }

    // Verifica o estado do painel de senha no sessionStorage e restaura ele
    let isNewPasswdOpen = sessionStorage.getItem("newPasswdState") === "open";
    
    if (isNewPasswdOpen) {
        newPasswdDiv.classList.remove("hidden");
        optionsDiv.classList.add("hidden");
    } else {
        newPasswdDiv.classList.add("hidden");
        optionsDiv.classList.remove("hidden");
    }

// Lógica do painel de opções
    const alterarLink = document.getElementById('alterar-link');

    if (alterarLink) {
        alterarLink.addEventListener('click', function () {
            event.preventDefault()
            newPasswdDiv.classList.remove('hidden'); // Remove a classe hidden da div new-passwd
            optionsDiv.classList.add('hidden'); // Adiciona a classe hidden na div options
            sessionStorage.setItem("newPasswdState", "open"); // Salva o estado como aberto
            
            // Rolagem suave para o painel de senha
            newPasswdDiv.scrollIntoView({ behavior: 'smooth' });
        });
    }

    // Ação de cancelar
    if (cancelButton) {
        cancelButton.addEventListener('click', (event) => {
            newPasswdDiv.classList.add('slide-out'); // Aplica o slideOut ao cancelar
            setTimeout(() => {
                newPasswdDiv.classList.add('hidden'); // Esconde a div após a animação
                optionsDiv.classList.remove('hidden'); // Mostra a div "options"
                newPasswdDiv.classList.remove('slide-out'); // Remove a classe de animação
                sessionStorage.setItem("newPasswdState", "closed");
            }, 300); // Duração do slideOut
        });
    }

    // Ação de voltar
    if (voltarButton) {
        voltarButton.addEventListener('click', (event) => {
            // Marca que o botão "Voltar" foi pressionado
            sessionStorage.setItem("voltarPressed", "true");
            sessionStorage.setItem("newPasswdState", "closed");

            // Aplica o slideOut ao voltar
            newPasswdDiv.classList.add('slide-out');

            // Envia os dados via AJAX
            sendBackPressedData();

            // Esconde a div após a animação e exibe a div "options"
            setTimeout(() => {
                newPasswdDiv.classList.add('hidden'); // Esconde a div
                optionsDiv.classList.remove('hidden'); // Mostra a div "options"
                newPasswdDiv.classList.remove('slide-out'); // Remove a animação

                sessionStorage.setItem("newPasswdState", "closed");

            }, 300); // Duração do slideOut (300ms)
        });
    }

    // Função para enviar a informação para o edit.php
    function sendBackPressedData() {
        const formData = new FormData();
        formData.append('voltarPressed', 'true'); // Envia a informação de que o "Voltar" foi pressionado

        // Faz o envio do POST via AJAX (sem recarregar a página)
        fetch('../../Controller/PHP-Controller/edit.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())  // Manipula a resposta do servidor
        .then(data => {
            console.log(data); // Aqui você pode verificar a resposta do servidor
        })
        .catch(error => console.error('Error:', error));
    }

    // Interceptando o envio do formulário (para evitar recarregar a página)
    document.getElementById('formEditar').addEventListener('submit', function(event) {
        if (sessionStorage.getItem("voltarPressed") === "true") {
            event.preventDefault(); // Impede o envio real do formulário
        }
    });

    // Lógica de salvar
    if (saveButton) {
        saveButton.addEventListener('click', function () {
            sessionStorage.setItem("newPasswdState", "open"); // Manter o painel aberto após o "salvar"
        });
    }


});
