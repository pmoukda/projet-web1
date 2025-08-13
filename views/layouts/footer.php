   </main>
     <footer class="pied-de-page">
        <nav class="nav-secondaire">
            <ul class="menu">
                <li>
                    <a class="menu-principal-lien" href="#">Contactez-nous</a>
                    <ul class=" menu-secondaire">
                        <li><a href="#">Angleterre</a></li>
                        <li><a href="#">Canada</a></li>
                        <li><a href="#">Us</a></li>
                        <li><a href="#">Australie</a></li>
                    </ul>
                </li>
                <li>
                    <a class="menu-principal-lien" href="#">Fonctionnement de la plateforme</a>
                    <ul class=" menu-secondaire">
                        <li><a href="#">Aide « Profil »</a></li>
                        <li><a href="#">Aide « Comment placer une offre »</a></li>
                        <li><a href="#">Aide « suivre une enchère »</a></li>
                        <li><a href="#">Aide « Trouver l'enchère désirée »</a></li>
                        <li><a href="#">Contacter le webmaster</a></li>
                    </ul>
                </li>
                <li>
                    <a class="menu-principal-lien" href="#">À propos de Lord Reginald Stampee III</a>
                    <ul class=" menu-secondaire">
                        <li><a href="#">La philatélie, c'est la vie.</a></li>
                        <li><a href="3">Biographie du Lord</a></li>
                        <li><a href="3">Historique familiale</a></li>
                    </ul>
                </li>
                <li><a class="menu-principal-lien" href="#">Termes et conditions</a></li>
            </ul>
            <a class="logo" href="{{base}}/home"><img class="logo" src="{{asset}}/img/logo/logo.webp" alt="logo"></a>
        </nav>
        <div class="contact">
            <p class="coordonnes">Adresse: <strong>345 Brayford Square London E1 0SG </strong></p>
            <p class="coordonnes">Téléphone: <strong> +44 1236 7643</strong></p>
            <p class="coordonnes">Courriel: <strong><a href="#">lord_stampee@stamp.com </a></strong></p>
            <div class="media">
                <p>Suivez-nous</p>
                <img class="icone" src="https://s2.svgbox.net/social.svg?ic=facebook&color=fff" alt="facebook" width="23" height="23">
                <img class="icone" src="https://s2.svgbox.net/social.svg?ic=instagram&color=fff" alt="instagram" width="23" height="23">
                <img class="icone" src="https://s2.svgbox.net/social.svg?ic=tiktok&color=fff" alt="tiktok" width="23" height="23">
            </div>
        </div>
        <p class="droit-auteur">Moukda &copy; 2025 Lord Stampee- Tous droits réservés</p>
    </footer>
           <script>
  // On attend que le DOM soit prêt
  document.addEventListener("DOMContentLoaded", function () {
    const sousMenus = document.querySelectorAll(".sous-menu > a");

    sousMenus.forEach(function (menu) {
      menu.addEventListener("click", function (e) {
        // Empêche le lien de se déclencher
        e.preventDefault();

        // Fermer les autres menus si tu veux un seul ouvert à la fois
        document.querySelectorAll(".sous-menu").forEach(function (el) {
          if (el !== menu.parentElement) {
            el.classList.remove("open");
          }
        });

        // Basculer l'ouverture du menu cliqué
        menu.parentElement.classList.toggle("open");
      });
    });
  });
</script>
</body>
</html>