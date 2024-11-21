document.addEventListener("DOMContentLoaded", function () {
    const configOverlay = document.getElementById("config-overlay");
    const deleteLink = document.getElementById("deletar-link");
    const cancelBtn = document.getElementById("cancel-btn");
    const deleteBtn = document.getElementById("delete-btn");

    let isCardOpen = false;

    // Verificar o parâmetro de sucesso na URL
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
            configOverlay.classList.add("hidden");
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
});
