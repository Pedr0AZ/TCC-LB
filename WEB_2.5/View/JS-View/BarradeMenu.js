document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.querySelector(".sidebar");
    const sidebarHeader = document.querySelector(".sidebar-header");
  
    // Inicia com a barra lateral escondida
    sidebar.classList.add("collapsed");
  
    // Alternar a visibilidade da barra lateral ao clicar no header
    sidebarHeader.addEventListener("click", () => {
      sidebar.classList.toggle("collapsed");
    });
  });
  

    // Tornar o .sidebar-header funcional quando a barra estiver escondida
    sidebarHeader.addEventListener("click", () => {
        if (sidebar.classList.contains("collapsed")) {
            sidebar.classList.remove("collapsed");
        }
    });
;

  // Adiciona funcionalidade de mostrar/ocultar submenus
  expandBtns.forEach(button => {
    button.addEventListener("click", (e) => {
      const submenu = e.target.nextElementSibling;
      button.classList.toggle("open");
      submenu.style.display = submenu.style.display === "block" ? "none" : "block";
    });
  });
;

// Efeitos de clique nos botões
const buttons = document.querySelectorAll("li");
buttons.forEach((button) => {
    button.addEventListener("mousedown", () => {
        button.style.transform = "scale(0.95)";
    });
    button.addEventListener("mouseup", () => {
        button.style.transform = "scale(1)";
    });
});
;
