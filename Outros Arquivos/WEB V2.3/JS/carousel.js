const carouselSlide = document.querySelector('.carousel-slide');
const carouselItems = document.querySelectorAll('.carousel-item');
const dots = document.querySelectorAll('.dot');
const specialBtn = document.querySelector('.special-btn');

let counter = 0;
const size = carouselItems[0].clientWidth;

// Função para atualizar a posição do carrossel e as bolinhas
function updateCarousel() {
    carouselSlide.style.transition = "transform 0.4s ease-in-out";
    carouselSlide.style.transform = 'translateX(' + (-size * counter) + 'px)';
    updateDots();

    // Adiciona a classe 'show' para fazer o fade-in na imagem atual e remove da anterior
    if (counter === 0) {
        specialBtn.classList.add('show');
    } else {
        specialBtn.classList.remove('show');
    }
}

// Função para atualizar as bolinhas de navegação
function updateDots() {
    dots.forEach((dot, index) => {
        dot.classList.remove('active');
        if (index === counter) {
            dot.classList.add('active');
        }
    });
}

// Evento para avançar para a próxima imagem
document.querySelector('.next-btn').addEventListener('click', () => {
    if (counter >= carouselItems.length - 1) {
        counter = -1; // Volta ao início
    }
    counter++;
    updateCarousel();
});

// Evento para voltar à imagem anterior
document.querySelector('.prev-btn').addEventListener('click', () => {
    if (counter <= 0) {
        counter = carouselItems.length; // Volta ao final
    }
    counter--;
    updateCarousel();
});

// Evento para clicar nas bolinhas de navegação
dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
        counter = index;
        updateCarousel();
    });
});

// Função para avançar automaticamente a cada 15 segundos
function autoSlide() {
    if (counter >= carouselItems.length - 1) {
        counter = -1; // Volta ao início
    }
    counter++;
    updateCarousel();
}

// Inicia o auto-slide
setInterval(autoSlide, 25000); // 15 segundos

// Configuração inicial
updateCarousel();
