{{include('layouts/header.php', {title:'Inscription'})}}
    <section class="formulaire">
    {% if errors is defined %}
        <div>
        {% for error in errors %}
            <p class="error">{{ error }}</p>
        {% endfor %}
    </div>
    {% endif %}
        <form action="{{base}}/utilisateur/store" method="post">
            <h1>Inscription</h1>
            <label for="nom">Nom</label>
            <input type="text" id="nom" name="nom" placeholder="Votre nom complet" value="{{utilisateur.nom}}" required>

            <label for="nom_utilisateur">Nom d&#39;utilisateur</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" value="{{utilisateur.nom_utilisateur}}" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" value="{{utilisateur.password}}">

            <label for="adresse">Adresse</label>
            <input type="text" id="adresse" name="adresse" value="{{utilisateur.adresse}}" required>

            <label for="ville_id">Ville</label>
            <select name="ville_id" id="ville_id">
                <option value="">Choisir une ville</option>
                {% for ville in villes %}
                <option value="{{ ville.id }}" {% if ville.id == utilisateur.ville_id %} selected {% endif %}>{{ ville.nom_ville }}</option>
                {% endfor %}
            </select>
          
            <label for="code_postal">Code Postal</label>
            <input type="text" id="code_postal" name="code_postal" value="{{utilisateur.code_postal}}" required>

            <label for="pays">Pays</label>
            <select name="pays_id" id="pays_id">
                <option value="">Choisir un pays</option>
                {% for pays in pays %}
                <option value="{{pays.id}}" {% if pays.id == utilisateur.pays_id%} selected {% endif %}>{{pays.nom_pays}}</option>
               {% endfor %}
            </select>
            <label for="email">Courriel</label>
            <input type="email" id="email" name="email" value="{{utilisateur.email}}" required>

            <label for="phone">Téléphone</label>
            <input type="text" id="phone" name="phone" value="{{utilisateur.phone}}" required>

            <input class="bouton rouge" type="submit" value="S'incrire">

            <div class="redirection">
            <p>Déjà un compte?</p>
            <a href="{{base}}/login">Se connecter</a>
        </div>
        </form>
    </section> 
{{ include('layouts/footer.php')}}