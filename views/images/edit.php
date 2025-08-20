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
        <h1>Modifier des images</h1>
        <form method="post" enctype="multipart/form-data">
            {% if images.timbre_id %}
                <p>Ajout d’image pour le timbre #{{ images.timbre_id }}</p>
                <input type="hidden" name="timbre_id" value="{{ images.timbre_id }}">
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
            <input type="file" id="liens_images" name="liens_images[]" accept="image/*" multiple>
            <input type="hidden" name="id" value="{{images.id }}">

            <input class="bouton rouge" type="submit" value="Enregistrer les modifications">
        </form>
       <a class="bouton blanc" href="{{base}}/images">Retour à la liste</a>
    </section>
{{include('layouts/footer.php')}}