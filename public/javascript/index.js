document.addEventListener('DOMContentLoaded', function() {
    const boutonHTML = document.getElementById('bouton-info');
    const boutonSupprimer = document.querySelector('#bouton-supprimer');
    console.log(boutonSupprimer);
    
        boutonHTML.addEventListener('click', function() {
        
            afficherSection('compte'); // Appel de la fonction pour afficher/masquer la section
        });

        if(boutonSupprimer){
            boutonSupprimer.addEventListener('click', function(event){
                event.preventDefault();

                const confirmation = confirm('Voulez-vous vraiment supprimer votre compte ?');

                if(confirmation){
                    const form = boutonSupprimer.closest('form');
                    form.submit();
                }

            });
        }
});
/**
 * fonction pour faire afficher et cacher les infos du compte utilisateur
 * @param {string} id 
 */
function afficherSection(id) {
    const section = document.getElementById(id);
    if (section) {
        section.classList.toggle('hidden');
    }
}
