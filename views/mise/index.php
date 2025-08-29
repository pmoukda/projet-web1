{{include('layouts/header.php', {title:'Mise index'})}}
<p class="salutation">Bonjour <strong>{{utilisateur.nom}} !</strong></p>
    <section class="liste" id="revenirEnHAut">
        <h1>Historique de vos mises</h1>
     {% if mises is not empty %}
        <table>
            <thead>
                <tr>
                    <th>ID enchère</th>
                    <th>Timbre</th>
                    <th>Mise $</th>
                    <th>Date de la mise</th>
                    <th>Date fin de l&#39 enchère</th>
                    <th>View</th>
                </tr>
            </thead>
           
            <tbody>
            {% for mise in mises %}
                <tr>
                    <td data-label="ID enchère">{{ mise.enchere.id }}</td>
                    <td data-label="Timbre">{{ mise.timbre.nom }}</td>
                    <td data-label="Mises $">{{ mise.prix }}</td>
                    <td data-label="Date de la mise">{{ mise.date }}</td>
                    <td data-label="Date fin de l&#39 enchère">{{ mise.enchere.date_fin }}</td>
                    <td>
                        <a class="bouton" href="{{base}}/enchere/view?id= {{mise.enchere.id}}">View</a>
                    </td>
                </tr>
            {% endfor %} 
            </tbody>
        </table>
         {% else %}
        <p>Aucune mise encore effectuée.</p>
    {% endif %}
    </section>
    <a class="vers-le-haut" href="#revenirEnHAut">Revenir en haut</a>
{{ include('layouts/footer.php')}}