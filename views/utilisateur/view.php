{{include ('layouts/header.php', {title: 'Profil membre'})}}
<p class="salutation">Bonjour <strong>{{utilisateur.nom}}</strong>, bienvenue sur votre profil membre !</p>
<section class="profil">
    <div class="profil_liens">
        <a class="bouton blanc" id="bouton-info" href="#">Mon compte</a>
        <a class="bouton blanc" href="{{base}}/favorie">Mes favories</a>
        <a class="bouton blanc" href="{{base}}/enchere?filtre=archivees">Enchères archivées</a>
        <a class="bouton blanc" href="{{base}}/timbre/create">Ajouter un timbre</a>
        <a class="bouton blanc" href="{{base}}/images/create">Ajouter des images</a>
        <a class="bouton blanc" href="{{base}}/timbre">Liste des timbres</a>
        <a class="bouton blanc" href="{{base}}/utilisateur">Liste des utilisateurs</a>
        <a class="bouton blanc" href="{{base}}/images">Liste des images</a>
        <a class="bouton blanc" href="{{base}}/enchere">Liste des enchères</a>
        <a class="bouton blanc" href="{{base}}/mise">Historique de mes mises</a>
    </div>
    <hr>
    <div id="compte" class="profil_section hidden">
        <h1 class="h2">Informations du compte</h1>
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
<section>
<h2>Mes enchères en cours</h2>
{% if timbres is not empty %}
        <article class="conteneur-petite-carte">
    {% for timbre in timbres %}
            <div class="petite-carte">
                <h2 class="h4">{{ timbre.nom }}</h2>
                <p>Timbre ID : {{ timbre.id }} </p>
                {% for enchere in encheres[timbre.id]%}
                <p>Enchere ID: {{enchere.id}}</p>
                <p>Date fin: {{enchere.date_fin}}</p>
                {% endfor %}
            {% for image in images[timbre.id] %}
                 {% if image.image_principale == 1 %}
                    <img src="{{asset}}/img/{{image.liens_images}}" alt="image principale">
                {% endif %}
            {%endfor%}
            </div>
    {% endfor %}
        </article>
{% else %}
    <p>Vous n’avez encore mis aucun timbre en enchère.</p>
{% endif %}
</section>
<hr>
<section>
    <h2>Mes mises récentes</h2>
    {% if mises is not empty %}
        <ul>
        {% for mise in mises %}
            <li>Mise de {{ mise.prix }} $ sur l’enchère #{{ mise.enchere_id }}</li>
        {% endfor %}
        </ul>
    {% else %}
        <p>Aucune mise effectuée.</p>
    {% endif %}
</section>

    <div class="profil_liens">
        <a class="bouton jaune" href="{{base}}/home">Retour à la page d&#39 accueil</a>
    </div>
</section>

{{include ('layouts/footer.php')}}
