{{include('layouts/header.php', {title:'Images index'})}}
    <section class="liste-img">
      
    </section>
   <p class="salutation">Bonjour <strong>{{utilisateur.nom}} !</strong></p>
    <section class="liste" id="revenirEnHAut">
        <h1>Catalogue d&#39images de timbres</h1>
        <table>
            <thead>
                <tr>
                    <th>ID de l&#39image</th>
                    <th>ID du timbre</th>
                    <th>Images</th>
                    <th>Image principale</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
            {% for image in images %}
                <tr>
                    <td data-label="ID de l&#39image">#{{image.id}}</td>
                    <td data-label="ID du timbre">#{{image.timbre_id}}</td>
                    <td data-label="Images"><img src="{{asset}}/img/{{image.liens_images}}" alt="{{image.timbre_id}}"></td>
                    <td data-label="Image principale">{{ image.image_principale == 1 ? 'Oui' : 'Non' }}</td>
                    <td>
                        <a class="bouton" href="{{base}}/images/view?id={{image.id}}">View</a>
                    </td>
                </tr>
            {% endfor %} 
            </tbody>
        </table>
    </section>
    <a class="vers-le-haut" href="#revenirEnHAut">Revenir en haut</a>
{{include('layouts/footer.php')}}