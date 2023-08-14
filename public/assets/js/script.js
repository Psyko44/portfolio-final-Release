window.addEventListener("DOMContentLoaded", (event) => {
  const sidebarWrapper = document.getElementById("sidebar-wrapper");
  const closeIcon = document.querySelector(".menu-toggle > .fa-xmark");
  let scrollToTopVisible = false;
  let sidebarVisible = false;
  // Closes the sidebar menu
  const menuToggle = document.body.querySelector(".menu-toggle");
  menuToggle.addEventListener("click", (event) => {
    event.preventDefault();
    toggleSidebar();
  });

  closeIcon.addEventListener("click", (event) => {
    event.preventDefault();
    toggleSidebar();
  });

  function toggleSidebar() {
    sidebarVisible = !sidebarVisible;
    sidebarWrapper.style.display = sidebarVisible ? "block" : "none";
    _toggleMenuIcon(); // Appel à la fonction pour changer l'icône du bouton
  }

  // Closes responsive menu when a scroll trigger link is clicked
  var scrollTriggerList = [].slice.call(
    document.querySelectorAll("#sidebar-wrapper .js-scroll-trigger")
  );
  scrollTriggerList.map((scrollTrigger) => {
    scrollTrigger.addEventListener("click", () => {
      sidebarWrapper.classList.remove("active");
      menuToggle.classList.remove("active");
      _toggleMenuIcon();
    });
  });

  function _toggleMenuIcon() {
    const menuToggleBars = document.body.querySelector(
      ".menu-toggle > .fa-bars"
    );
    const menuToggleTimes = document.body.querySelector(
      ".menu-toggle > .fa-xmark"
    );
    if (menuToggleBars) {
      menuToggleBars.classList.remove("fa-bars");
      menuToggleBars.classList.add("fa-xmark");
    }
    if (menuToggleTimes) {
      menuToggleTimes.classList.remove("fa-xmark");
      menuToggleTimes.classList.add("fa-bars");
    }
  }

  // Scroll to top button appear
  document.addEventListener("scroll", () => {
    const scrollToTop = document.body.querySelector(".scroll-to-top");
    if (document.documentElement.scrollTop > 100) {
      if (!scrollToTopVisible) {
        fadeIn(scrollToTop);
        scrollToTopVisible = true;
      }
    } else {
      if (scrollToTopVisible) {
        fadeOut(scrollToTop);
        scrollToTopVisible = false;
      }
    }
  });
});

function fadeOut(el) {
  el.style.opacity = 1;
  (function fade() {
    if ((el.style.opacity -= 0.1) < 0) {
      el.style.display = "none";
    } else {
      requestAnimationFrame(fade);
    }
  })();
}

function fadeIn(el, display) {
  el.style.opacity = 0;
  el.style.display = display || "block";
  (function fade() {
    var val = parseFloat(el.style.opacity);
    if (!((val += 0.1) > 1)) {
      el.style.opacity = val;
      requestAnimationFrame(fade);
    }
  })();
}

let textToType = "";

// Définissez le texte pour chaque page
if (window.location.pathname === "/") {
  textToType =
    "Développement sécurisé pour un monde connecté.\n(En cours de Sécurisation)";
} else if (window.location.pathname === "/home") {
  textToType =
    "Bonjour, je suis Psyko, alias DANNY. <br>Bienvenue dans mon espace dedie au developpement securise et à la cyber securite<br> Où la technologie rencontre la protection pour un monde connecte en toute confiance.<br> Explorez mes projets, decouvrez mes competences<br>Suivez-moi dans ce voyage passionnant à travers la securite numerique.<br> Ensemble, protegeons l'avenir du web !";
}

let characterIndex = 0;
let isDeleting = false;

function type() {
  if (window.innerWidth >= 992) {
    // Vérifiez si la largeur de l'écran est supérieure ou égale à 992px
    const currentText = isDeleting
      ? textToType.substring(0, characterIndex - 1)
      : textToType.substring(0, characterIndex + 1);

    document.getElementById("typed-text").innerHTML = currentText.replace(
      /\n/g,
      "<br>"
    );

    if (currentText === textToType && !isDeleting) {
      setTimeout(() => (isDeleting = true), 1000);
    } else if (isDeleting && characterIndex === 0) {
      isDeleting = false;
    }

    characterIndex = isDeleting ? characterIndex - 1 : characterIndex + 1;

    setTimeout(type, isDeleting ? 100 : 100);
  }
}

type();

document.getElementById("enterButton").addEventListener("click", function () {
  const glitchEffect = document.getElementById("glitch-effect");

  glitchEffect.style.zIndex = 2000;
  glitchEffect.style.opacity = 1;

  setTimeout(function () {
    window.location.href = "/home";
  }, 3000);
});

document.addEventListener("DOMContentLoaded", function () {
  if (window.location.pathname === "/") {
    document.querySelector(".footer").style.display = "none";
    document.querySelector(".navHead").style.display = "none";
  } else {
    document.querySelector(".footer").style.display = "block";
    document.querySelector(".navHead").style.display = "block";
  }
});
