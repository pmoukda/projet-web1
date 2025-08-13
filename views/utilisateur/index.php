{{include('layouts/header.php', {title:'utilisateur index'})}}
    <section class="liste">
        <h1>Liste des utilisateurs</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Nom d&#39utilisateur</th>
                    <th>Courriel</th>
                    <th>Password</th>
                    <th>Date de création</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Code Postale</th>
                    <th>Privilège Id</th>
                    <th>Ville Id</th>
                    <th>Pays Id</th>
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
                    <td>{{ utilisateur.password }}</td>
                    <td>{{ utilisateur.date_creation }}</td>
                    <td>{{ utilisateur.adresse }}</td>
                    <td>{{ utilisateur.phone }}</td>
                    <td>{{ utilisateur.code_postal }}</td>
                    <td>{{ utilisateur.privilege_id }}</td>
                    <td>{{ utilisateur.ville_id }}</td>
                    <td>{{ utilisateur.pays_id }}</td>
                    <td>
                        <a class="bouton" href="{{base}}/utilisateur/view?id= {{utilisateur.id}}">View</a>
                    </td>
                </tr>
            {% endfor %} 
            </tbody>
        </table>
    </section>
{{ include('layouts/footer.php')}}