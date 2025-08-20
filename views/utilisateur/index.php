{{include('layouts/header.php', {title:'utilisateur index'})}}
<p class="salutation">Bonjour <strong>{{utilisateur.nom}} !</strong></p>
    <section class="liste" id="revenirEnHAut">
        <h1>Liste des utilisateurs</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Nom d&#39utilisateur</th>
                    <th>Courriel</th>
                    <th>Date de création</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Code Postale</th>
                    <th>Privilège</th>
                    <th>Ville</th>
                    <th>Pays</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
            {% for utilisateur in utilisateurs %}
                <tr>
                    <td data-label="ID">{{ utilisateur.id }}</td>
                    <td data-label="Nom">{{ utilisateur.nom }}</td>
                    <td data-label="Nom d'utilisateur">{{ utilisateur.nom_utilisateur }}</td>
                    <td data-label="Courriel">{{ utilisateur.email }}</td>
                    <td data-label="Date de création">{{ utilisateur.date_creation }}</td>
                    <td data-label="Adresse">{{ utilisateur.adresse }}</td>
                    <td data-label="Téléphone">{{ utilisateur.phone }}</td>
                    <td data-label="Code Postale">{{ utilisateur.code_postal }}</td>
                    <td data-label="Privilège">{{ privileges[utilisateur.privilege_id] }}</td>
                    <td data-label="Ville">{{ villes[utilisateur.ville_id] }}</td>
                    <td data-label="Pays">{{ pays[utilisateur.pays_id] }}</td>
                    <td>
                        <a class="bouton" href="{{base}}/utilisateur/view?id= {{utilisateur.id}}">View</a>
                    </td>
                </tr>
            {% endfor %} 
            </tbody>
        </table>
    </section>
    <a class="vers-le-haut" href="#revenirEnHAut">Revenir en haut</a>
{{ include('layouts/footer.php')}}