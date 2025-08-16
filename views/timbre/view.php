{{include('layouts/header.php', {title:'Timbre view'})}}
<p class="salutation">Bonjour <strong>{{utilisateur.nom}} !</strong></p>
    <h1>Détails du timbre</h1>
    <section class="infos">
        <p><strong>Titre :</strong> {{ timbre.nom }}</p>
        <p><strong>Année:</strong> {{ timbre.annee }}</p>
        <p><strong>Tirage:</strong> {{ timbre.tirage }}</p>
        <p><strong>Dimensions:</strong> {{ timbre.dimensions }}</p>
        <p><strong>Certifié:</strong> {{ timbre.certifie == 1 ? 'Oui' : 'Non' }}</p>
        <p><strong>Condition:</strong> {{ conditions }}</p>
        <p><strong>Couleur:</strong> {{ couleurs }}</p>
        <p><strong>Pays:</strong> {{ pays }}</p>
        <p><strong>Description:</strong> {{ timbre.description }}</p>
        <p><strong>Utilisateur:</strong> {{ utilisateur }}</p>

        <div class="profil_liens">
            <a href="{{ base }}/timbre/edit?id={{ timbre.id }}" class="bouton jaune ">Modifier</a>
            <form method="POST" action="{{ base }}/timbre/delete">
                <input type="hidden" name="id" value="{{ timbre.id }}">
                <button type="submit" id="bouton-supprimer" class="bouton rouge">Supprimer</button>
            </form>
            <a class="bouton blanc" href="{{base}}/timbre">Retour à la liste</a>
        </div>
    </section>
{{include('layouts/footer.php')}}