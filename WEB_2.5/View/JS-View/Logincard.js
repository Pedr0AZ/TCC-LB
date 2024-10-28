document.addEventListener("DOMContentLoaded", function() {
    const overlay = document.getElementById("overlay");
    const loginCard = document.getElementById("loginCard");
    const signupCard = document.getElementById("signupCard");
    const submitLogin = document.getElementById("login-submit"); 
    const submitSignup = document.getElementById("signup-submit"); 
    const goToMda = document.getElementById("go-to-mda");
    const message = document.getElementById("message");
    const perfilMenuWrap = document.getElementById("perfilMenu-wrap");
    const perfilButton = document.getElementById("perfil"); 
    const loginButton = document.getElementById("login-btn"); 

    let formSubmitted = false;

    // Mostrar o card certo no início
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
        overlay.style.display = "none"; 
        loginCard.classList.add("hidden");
        signupCard.classList.add("hidden");
    }

    if (message && message.innerText.includes("Login realizado com sucesso!")) { 
        goToMda.classList.remove("hidden");
    }

    // Ação de exibir formulário de login
    if (loginButton) {
        loginButton.addEventListener("click", function() {
            overlay.style.display = "flex";
            loginCard.classList.remove("hidden");
            signupCard.classList.add("hidden");
            sessionStorage.setItem('currentCard', 'login');
        });
    }

    overlay.addEventListener("click", function(event) {
        if (event.target === this) {
            this.style.display = "none";
            sessionStorage.removeItem('currentCard');
            loginCard.classList.add("hidden");
            signupCard.classList.add("hidden");
            perfilMenuWrap.classList.add("hidden");
            formSubmitted = false;
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

    if (perfilButton) {
        loginButton.classList.add("hidden");

        perfilButton.addEventListener("click", function(event) {
            event.stopPropagation();
            perfilMenuWrap.classList.toggle("hidden");
        });

        document.addEventListener("click", function(event) {
            if (!perfilMenuWrap.contains(event.target) && !perfilButton.contains(event.target)) {
                perfilMenuWrap.classList.add("hidden");
            }
        });
    } else {
        loginButton.classList.remove("hidden");
    }

    submitLogin.addEventListener("click", function() {
        sessionStorage.setItem('currentCard', 'login'); 
        formSubmitted = true; 
    });

    submitSignup.addEventListener("click", function() {
        sessionStorage.setItem('currentCard', 'signup'); 
        formSubmitted = true; 
    });

    window.addEventListener("beforeunload", function() {
        if (!formSubmitted) {
            sessionStorage.removeItem('currentCard');
        }
    });
});
