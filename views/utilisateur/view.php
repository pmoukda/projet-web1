{{include ('layouts/header.php', {title: 'Profil membre'})}}
<p class="salutation">Bonjour <strong>{{utilisateur.nom}}</strong>, bienvenue sur votre profil membre !</p>
<section class="profil">
    <div class="profil_liens">
        <a class="bouton blanc" id="bouton-info" href="#">Mon compte</a>
        <a class="bouton blanc" href="{{base}}/favorie_enchere">Mes favories</a>
        <a class="bouton blanc" href="{{base}}/enchere">Enchères archivées</a>
        <a class="bouton blanc" href="{{base}}/timbre/create">Ajouter un timbre</a>
    </div>
    <h1>Vos enchères</h1>
    <p>Bonjour, vous n&#39 avez pas d'enchères récentes.</p>
    <div class="profil_liens">
        <a class="bouton jaune" href="{{base}}/home">Retour à la page d&#39 accueil</a>
    </div>

    <div id="compte" class="profil_section hidden">
        <h2>Informations du compte</h2>
        <p>{{ utilisateur.nom }}</p>
        <p>{{ utilisateur.adresse }}, {{ utilisateur.code_postal }}</p>
        <p>{{ ville }}, {{ pays }} </p>
        <p>{{ utilisateur.phone }}</p>
        <p>{{ utilisateur.email }}</p>
        <p>Nom d&#39 utilisateur : {{ utilisateur.nom_utilisateur }}</p>

    <div class="profil_liens">
        <a href="{{ base }}/utilisateur/edit?id={{ utilisateur.id }}" class="bouton jaune ">Modifier</a>
        <form method="POST" action="{{ base }}/utilisateur/delete">
            <input type="hidden" name="id" value="{{ utilisateur.id }}">
            <button type="submit" id="bouton-supprimer" class="bouton rouge">Supprimer</button>
        </form>
    </div>
</div>

</section>

{{include ('layouts/footer.php')}}
