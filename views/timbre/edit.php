{{include('layouts/header.php', {title:'Modifier timbre'})}}
<p class="salutation">Bonjour <strong>{{utilisateur.nom}} !</strong></p>
    <section class="formulaire">
    {% if errors is defined %}
        <div>
        {% for error in errors %}
            <p class="error">{{ error }}</p>
        {% endfor %}
    </div>
    {% endif %}
    <h1>Modifier un timbre</h1>
        <form method="post">
            <label for="nom">Titre</label>
            <input type="text" id="nom" name="nom" minlength="2" maxlength="100" value="{{timbre.nom}}" required>

            <label for="annee">Année</label>
            <input type="text" id="annee" name="annee" pattern="^\d{4}$" value="{{timbre.annee}}" required>

            <label for="tirage">Tirage</label>
            <input type="number" id="tirage"min="1" max="1000" name="tirage" value="{{timbre.tirage}}">

            <label for="dimensions">Dimensions</label>
            <input type="text" id="dimensions" name="dimensions" maxlength="45" value="{{timbre.dimensions}}" required>

            <label for="condition_id">Condition</label>
            <select name="condition_id" id="condition_id" required>
                <option value="">Choisir une condition</option>
                {% for condition in conditions %}
                <option value="{{ condition.id }}" {% if condition.id == timbre.condition_id %} selected {% endif %}>{{ condition.etat}}</option>
                {% endfor %}
            </select>
    
            <legend>Certitié</legend>
                <div>
                    <input type="radio" id="certifieOui" name="certifie" value="1" required {%if timbre.certifie == 1 %} checked {% endif %}>
                    <label for="certifieOui">Oui
                </div> 
                <div>   
                    <input type="radio" id="certifieNon" name="certifie" value="0" required {%if timbre.certifie == 0 %} checked {% endif %}>
                    <label for="certifieNon">Non</label>
                </div>

            <label for="pays">Pays</label>
            <select name="pays_id" id="pays_id" required>
                <option value="">Choisir un pays</option>
                {% for pays in pays %}
                <option value="{{pays.id}}" {% if pays.id == timbre.pays_id%} selected {% endif %}>{{pays.nom_pays}}</option>
               {% endfor %}
            </select>
           
            <label for="couleur_id">Couleur</label>
            <select name="couleur_id" id="couleur_id" required>
                <option value="">Choisir une couleur</option>
                {% for couleur in couleurs %}
                <option value="{{couleur.id}}" {% if couleur.id == timbre.couleur_id%} selected {% endif %}>{{couleur.couleur}}</option>
               {% endfor %}
            </select>
            <label 

            <label for="description">Description</label>
            <textarea name="description" id="description" rows="10" maxlength="1000">{{timbre.description}}</textarea>

           <input type="hidden" id="utilisateur_id" name="utilisateur_id" value="{{timbre.utilisateur_id}}">
           <input class="bouton rouge" type="submit" value="Enregistrer les modifications">
        </form>
        <a class="bouton blanc" href="{{base}}/timbre">Retour à la liste</a>
    </section> 
{{include('layouts/footer.php')}}