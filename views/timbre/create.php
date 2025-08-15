{{include('layouts/header.php', {title:'Création timbre'})}}
       <section class="formulaire">
    {% if errors is defined %}
        <div>
        {% for error in errors %}
            <p class="error">{{ error }}</p>
        {% endfor %}
    </div>
    {% endif %}
    <h1>Ajouter un timbre</h1>
        <form action="{{base}}/timbre/store" method="post">
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom"  value="{{timbre.nom}}" required>

            <label for="annee">Année</label>
            <input type="text" id="annee" name="annee" value="{{timbre.annee}}" required>

            <label for="tirage">Tirage</label>
            <input type="number" id="tirage" name="tirage" value="{{timbre.tirage}}">

            <label for="dimensions">Dimensions</label>
            <input type="text" id="dimensions" name="dimensions" value="{{timbre.dimensions}}" required>


            <label for="condition_id">Condition</label>
            <select name="condition_id" id="condition_id">
                <option value="">Choisir une condition</option>
                {% for condition in conditions %}
                <option value="{{ condition.id }}" {% if condition.id == timbre.condition_id %} selected {% endif %}>{{ condition.etat}}</option>
                {% endfor %}
            </select>
    
            <legend>Certitié</legend>
                <div>
                    <input type="radio" id="certifieOui" name="certifie" value="1" {%if timbre.certifie == 1 %} checked {% endif %}>
                    <label for="certifieOui">Oui
                </div> 
                <div>   
                    <input type="radio" id="certifieNon" name="certifie" value="0" {%if timbre.certifie == 0 %} checked {% endif %}>
                    <label for="certifieNon">Non</label>
                </div>

            <label for="pays">Pays</label>
            <select name="pays_id" id="pays_id">
                <option value="">Choisir un pays</option>
                {% for pays in pays %}
                <option value="{{pays.id}}" {% if pays.id == timbre.pays_id%} selected {% endif %}>{{pays.nom_pays}}</option>
               {% endfor %}
            </select>
           
            <label for="couleur_id">Couleur</label>
            <select name="couleur_id" id="couleur_id">
                <option value="">Choisir une couleur</option>
                {% for couleur in couleurs %}
                <option value="{{couleur.id}}" {% if couleur.id == timbre.couleur_id%} selected {% endif %}>{{couleur.couleur}}</option>
               {% endfor %}
            </select>
            <label 

            <label for="description">Description</label>
            <textarea name="description" id="description" rows="10" value="{{timbre.description}}"></textarea>

            <input type="number" id="utilisateur_id" name="utilisateur_id" value="{{timbre.utilisateur_id}}">

            <input class="bouton rouge" type="submit" value="Ajouter">
        </form>
    </section> 
{{ include('layouts/footer.php')}}