{{include('layouts/header.php', {title:'Images create'})}}
    <p class="salutation">Bonjour <strong>{{utilisateur.nom}} !</strong></p>
    <section class="formulaire">
        {% if errors is defined %}
            <div>
                {% for error in errors %}
                    <p class="error">{{ error }}</p>
                {% endfor %}
            </div>
        {% endif %}
        <h1>Ajouter des images</h1>
        <form action="{{base}}/images/store" method="post" enctype="multipart/form-data">
            {% if timbre_id %}
                <p>Ajout d’image pour le timbre #{{ timbre_id }}</p>
            {% endif %}
            <legend>Image principale</legend>
            <div>
                <input type="radio" id="image_principale_oui" name="image_principale" value="1" {% if images.image_principale == 1 %} checked {% endif %}>
                <label for="image_principale_oui">Oui</label>
            </div>
            <div>
                <input type="radio" id="image_principale_non" name="image_principale" value="0" {% if images.image_principale == 0 %} checked {% endif %}>
                <label for="image_principale_non">Non</label>
            </div>
            <label for="liens_images">Choisir des images</label>
            <input type="file" id="liens_images" name="liens_images[]" multiple>
            <input type="hidden" name="timbre_id" value="{{ timbre_id }}">

            <input class="bouton rouge" type="submit" value="Ajouter les images">
        </form>
        <a class="vers-le-haut" href="{{base}}/utilisateur/view?id={{utilisateur.id}}">Retour au profil membre</a>
  
    </section>

{{include('layouts/footer.php')}}


