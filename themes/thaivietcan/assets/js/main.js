
const logged = document.querySelector('.logged ');
const headerLogin = document.querySelector('.header__login ');

// Logged
const handleLogged = function() {
  logged.addEventListener("click", function() {
    headerLogin.classList.toggle('active');
  });
}

// Call Functions
handleLogged();

  