{{include('layouts/header.php', {title:'Enchere view'})}}
<p class="salutation">Bonjour <strong>{{utilisateur.nom}} !</strong></p>
<h1>Vos favoris</h1>
{% if favories is empty %}
    <p>Vous n&#39avez aucun favorie pour le moment</p>
{% else %}
    <ul>
        {% for favori in favories %}
            <li>
                <p>Enchère : {{ favori.enchere_id }}</p>
                <a href="{{ base }}/enchere/view?id={{ favori.enchere_id }}">Voir l&#39enchère</a>
            </li>
        {% endfor %}
    </ul>
{% endif %}
{{include('layouts/footer.php')}}
