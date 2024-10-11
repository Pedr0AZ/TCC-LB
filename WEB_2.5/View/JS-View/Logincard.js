document.addEventListener("DOMContentLoaded", function() {
    const overlay = document.getElementById("overlay");
    const loginCard = document.getElementById("loginCard");
    const signupCard = document.getElementById("signupCard");
    const submitLogin = document.getElementById("login-submit"); 
    const submitSignup = document.getElementById("signup-submit"); 
    const goToMda = document.getElementById("go-to-mda");
    const message = document.getElementById("message");
    const pLogin = document.getElementById("login-p");

    let formSubmitted = false; //detectar se um formulário foi enviado

    // Verificar o estado do card na inicialização
    const currentCard = sessionStorage.getItem('currentCard');
    if (currentCard === 'login') {
        overlay.style.display = "flex"; 
        loginCard.classList.remove("hidden");
        signupCard.classList.add("hidden");
    } else if (currentCard === 'signup') {
        overlay.style.display = "flex"; 
        signupCard.classList.remove("hidden");
        loginCard.classList.add("hidden");
    } else {
        overlay.style.display = "none"; // Oculta o overlay se não houver estado
        loginCard.classList.add("hidden");
        signupCard.classList.add("hidden");
    }

    if (message && message.innerText.includes("Login realizado com sucesso!")) { 
        goToMda.classList.remove("hidden"); // Mostra o botão de "Ir para o Menu de Atividades"
        pLogin.classList.add("hidden");
        submitLogin.classList.add("hidden");

        goToMda.addEventListener("click", function() {
            event.preventDefault();
            console.log("Botão 'Ir para o Menu de Atividades' clicado!");
            window.location.href = "Mda.html"; // Redireciona para o menu de atividades
        });
    }

    document.getElementById("login-btn").addEventListener("click", function() {
        overlay.style.display = "flex"; // Mostra o card de login
        loginCard.classList.remove("hidden");
        signupCard.classList.add("hidden");
        sessionStorage.setItem('currentCard', 'login'); // Armazena o estado do card ao abrir
    });

    overlay.addEventListener("click", function(event) {
        if (event.target === this) {
            this.style.display = "none"; // Oculta o card de login ou cadastro
            sessionStorage.removeItem('currentCard'); // Remove o estado do card
            loginCard.classList.add("hidden");
            signupCard.classList.add("hidden");
            formSubmitted = false; // Reinicia a variável ao clicar fora
        }
    });

    document.getElementById("create-account-link").addEventListener("click", function() {
        loginCard.classList.add("hidden");
        signupCard.classList.remove("hidden");
        sessionStorage.setItem('currentCard', 'signup'); 
    });

    document.getElementById("login-link").addEventListener("click", function() {
        signupCard.classList.add("hidden");
        loginCard.classList.remove("hidden");
        sessionStorage.setItem('currentCard', 'login'); 
    });

    submitLogin.addEventListener("click", function() {
        // Aqui você pode adicionar lógica para o login, como validação
        sessionStorage.setItem('currentCard', 'login'); 
        formSubmitted = true; 
    });

    submitSignup.addEventListener("click", function() {
        sessionStorage.setItem('currentCard', 'signup'); 
        formSubmitted = true; 
    });

    window.addEventListener("beforeunload", function() {
        if (!formSubmitted) {
            sessionStorage.removeItem('currentCard'); // Limpa o estado do card se não houve envio
        }
    });
});
