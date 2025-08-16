{{include('layouts/header.php', {title:'utilisateur index'})}}
<p class="salutation">Bonjour <strong>{{utilisateur.nom}} !</strong></p>
    <section class="liste">
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
                    <td>{{ utilisateur.id }}</td>
                    <td>{{ utilisateur.nom }}</td>
                    <td>{{ utilisateur.nom_utilisateur }}</td>
                    <td>{{ utilisateur.email }}</td>
                    <td>{{ utilisateur.date_creation }}</td>
                    <td>{{ utilisateur.adresse }}</td>
                    <td>{{ utilisateur.phone }}</td>
                    <td>{{ utilisateur.code_postal }}</td>
                    <td>{{ privileges[utilisateur.privilege_id] }}</td>
                    <td>{{ villes[utilisateur.ville_id] }}</td>
                    <td>{{ pays[utilisateur.pays_id] }}</td>
                    <td>
                        <a class="bouton" href="{{base}}/utilisateur/view?id= {{utilisateur.id}}">View</a>
                    </td>
                </tr>
            {% endfor %} 
            </tbody>
        </table>
    </section>
{{ include('layouts/footer.php')}}