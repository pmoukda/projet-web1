{{include('layouts/header.php', {title:'Authentification'})}}
<section class="formulaire">
  {% if errors is defined %}
        <div>
        {% for error in errors %}
            <p class="error">{{ error }}</p>
        {% endfor %}
    </div>
    {% endif %}
    <form method="post">
    <h1>Se connecter</h1>
        <label for="nom_utilisateur">Nom d&#39;utilisateur</label>
        <input type="email" name="nom_utilisateur" value="{{ utilisateur.nom_utilisateur }}">
        
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
      
        <label for="rememberMe">
            <input type="checkbox" id="rememberMe" name="rememberMe"> Se souvenir de moi
        </label> 
        <a href="#">Vous avez oublié votre nom utilisateur?</a>
        <a href="#">Vous avez oublié votre mot de passe?</a>
        <input type="submit" class="bouton rouge" value="Se connecter">

        <div class="redirection">
            <p>Pas de compte?</p>
            <a href="{{base}}/utilisateur/create">S&#39;incrire</a>
        </div>
        
    </form>
</section>

{{ include('layouts/footer.php')}}
