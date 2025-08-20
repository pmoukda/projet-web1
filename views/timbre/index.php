{{include('layouts/header.php', {title:'Timbre index'})}}
<p class="salutation">Bonjour <strong>{{utilisateur.nom}} !</strong></p>
    <section class="liste" id="revenirEnHAut">
        <h1>Liste des timbres</h1>
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
                    <td data-label="ID">{{ timbre.id }}</td>
                    <td data-label="Nom">{{ timbre.nom }}</td>
                    <td data-label="Année">{{ timbre.annee }}</td>
                    <td data-label="Date de création">{{ timbre.date_creation }}</td>
                    <td data-label="Tirage">{{ timbre.tirage }}</td>
                    <td data-label="Dimensions">{{ timbre.dimensions }}</td>
                    <td data-label="Certifié">{{ timbre.certifie == 1 ? 'Oui' : 'Non' }}</td>
                    <td data-label="Description">{{ timbre.description }}</td>
                    <td data-label="Condition">{{ conditions[timbre.condition_id] }}</td>
                    <td data-label="Couleur">{{ couleurs[timbre.couleur_id] }}</td>
                    <td data-label="Pays">{{ pays[timbre.pays_id] }}</td>
                    <td data-label="Utilisateur">{{ utilisateurs[timbre.utilisateur_id] }}</td>
                    <td>
                        <a class="bouton" href="{{base}}/timbre/view?id={{timbre.id}}">View</a>
                    </td>
                </tr>
            {% endfor %} 
            </tbody>
        </table>
    </section>
    <a class="vers-le-haut" href="#revenirEnHAut">Revenir en haut</a>
{{include('layouts/footer.php')}}