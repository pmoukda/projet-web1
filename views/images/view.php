{{include('layouts/header.php', {title:'Images view'})}}

    <p class="salutation">Bonjour <strong>{{utilisateur.nom}} !</strong></p>
    <h1>Modifier une image</h1>
    <section class="infos">
    {% if errors is defined %}
    <div>
        {% for error in errors %}
            <p class="error">{{ error }}</p>
        {% endfor %}
    </div>
    {% endif %}
        <p><strong>ID de l’image :</strong> # {{ images.id }}</p>
        <p><strong>ID du timbre :</strong> # {{ timbre.id }}</p>
        <p><strong>Timbre associé :</strong> {{ timbre.nom }}</p>
        <img src="{{asset}}/img/{{images.liens_images}}" alt="{{images.liens_images}}">
      
        <div class="profil_liens">
            <a href="{{ base }}/images/edit?id={{ images.id }}" class="bouton jaune ">Modifier</a>
            <form method="POST" action="{{ base }}/images/delete">
                <input type="hidden" name="id" value="{{ images.id }}">
                <button type="submit" id="bouton-supprimer" class="bouton rouge">Supprimer</button>
            </form>
            <a class="bouton blanc" href="{{base}}/images">Retour à la liste</a>
            <a class="bouton blanc" href="{{ base }}/timbre/view?id={{ images.timbre_id }}">Retour au timbre</a>
        </div>
    </section>
{{include('layouts/footer.php')}}