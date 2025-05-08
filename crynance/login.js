document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById('login-form');
    const signupForm = document.getElementById('signup-form');
    const formTitle = document.getElementById('form-title');
    const toggleLink = document.querySelector('.toggle-link');
  
    // Gestion du switch entre connexion et inscription
    toggleLink.addEventListener("click", () => {
      const isLoginVisible = !loginForm.classList.contains("hidden");
  
      loginForm.classList.toggle("hidden");
      signupForm.classList.toggle("hidden");
  
      formTitle.textContent = isLoginVisible ? "Inscription" : "Connexion";
      toggleLink.textContent = isLoginVisible
        ? "Déjà inscrit ? Se connecter"
        : "Pas encore inscrit ? Créer un compte";
  
      // Petite animation de fade-in sur le formulaire affiché
      const activeForm = isLoginVisible ? signupForm : loginForm;
      activeForm.style.opacity = 0;
      setTimeout(() => {
        activeForm.style.transition = "opacity 0.3s";
        activeForm.style.opacity = 1;
      }, 50);
    });
  });
