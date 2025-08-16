{{include('layouts/header.php', {title:'Timbre index'})}}
<p class="salutation">Bonjour <strong>{{utilisateur.nom}} !</strong></p>
    <section class="liste">
        <h1>Liste de mes timbres</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Année</th>
                    <th>Date de création</th>
                    <th>Tirage</th>
                    <th>Dimensions</th>
                    <th>Certifié</th>
                    <th>Description</th>
                    <th>Condition</th>
                    <th>Couleur</th>
                    <th>Pays</th>
                    <th>Utilisateur</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
            {% for timbre in timbres %}
                <tr>
                    <td>{{ timbre.id }}</td>
                    <td>{{ timbre.nom }}</td>
                    <td>{{ timbre.annee }}</td>
                    <td>{{ timbre.date_creation }}</td>
                    <td>{{ timbre.tirage }}</td>
                    <td>{{ timbre.dimensions}}</td>
                    <td>{{ timbre.certifie == 1 ? 'Oui' : 'Non' }}</td>
                    <td>{{ timbre.description }}</td>
                    <td>{{ conditions[timbre.condition_id]}}</td>
                    <td>{{ couleurs[timbre.couleur_id]}}</td>
                    <td>{{ pays[timbre.pays_id]}}</td>
                    <td>{{ utilisateurs[timbre.utilisateur_id]}}</td>
                    <td>
                        <a class="bouton" href="{{base}}/timbre/view?id= {{timbre.id}}">View</a>
                    </td>
                </tr>
            {% endfor %} 
            </tbody>
        </table>
    </section>
{{include('layouts/footer.php')}}