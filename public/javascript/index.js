// Sélection HTML
const boutonHTML = document.getElementById("bouton-info");
const boutonSupprimer = document.querySelector("#bouton-supprimer");

// console.log("boutonHTML:", boutonHTML);
// console.log("boutonSupprimer:", boutonSupprimer);

function init() {
 
  if (boutonHTML) {
    boutonHTML.addEventListener("click", function () {
      afficherSection("compte");
    });
  }

  if (boutonSupprimer) {
    boutonSupprimer.addEventListener("click", function (event) {
      event.preventDefault();
      const confirmation = confirm("Voulez-vous vraiment supprimer votre compte ?");
      if (confirmation) {
        const form = boutonSupprimer.closest("form");
        if (form) {
          form.submit();
        } else {
          console.error("Aucun formulaire trouvé autour du bouton.");
        }
      }
    });
  }
}

function afficherSection(id) {
  const section = document.getElementById(id);
  if (section) {
    section.classList.toggle("hidden");
  }
}

 init();


