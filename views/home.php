{{include ('layouts/header.php', {title: 'Accueil'})}}
<section class="intro">
    <div>
        <h2>Lord Stampee, philatéliste d’Angleterre</h2>
        <div class="bio">
            <p>Lord Stampee est un noble britannique, passionné de philatélie, l&#39art de collectionner les timbres-poste. Né à Londres en 1947, il aurait découvert sa vocation lors d&#39un voyage en Inde, où il fut fasciné par les timbres coloniaux aux couleurs vives.</p>
            <p>Connu pour son raffinement et son obsession du détail, Lord Stampee consacre sa fortune familiale à l'acquisition de timbres rares issus des quatre coins de l'Empire britannique. Sa collection légendaire, surnommée<strong> The Crowned Stamps</strong>, comprendrait des pièces mythiques comme <strong>la Penny Black, la Blue Mauritius</strong>, et une version imprimée à l’envers du timbre royal australien.</p>
            <p>Toujours vêtu d’un costume gris impeccable et d’un monocle, <strong>Lord Stampee aurait fondé le Royal Circle of Stamp Enthusiasts</strong>, où seuls les collectionneurs ayant au moins un timbre datant d’avant 1850 pouvaient être admis.</p>
        </div>
        <a class="bouton blanc"href="#">En savoir plus</a>
    </div>
</section>
<hr>
<div class="conteneur-principal">
    <section class="grille">
        <div class="groupe-titre">
            <h2>Offres vedettes</h2>
        </div>
        <div class="conteneur">
        {% for enchere in encheres %}
            <article class="carte">
            {% if enchere.coups_de_coeur_du_Lord == 1 %}
                <div class="coup-coeur lord">
                    <p>Coup de coeur du Lord</p>
                </div>
            {% endif %}
                <img src="{{ asset }}/img/{{enchere.liens_images }}" alt="Image principale">
                <h3>{{enchere.nom}}</h3>
                <span>CA${{ enchere.prix_plancher }}</span>
                <small>Offres: 3</small>
                <img class="icon" src="https://s2.svgbox.net/hero-outline.svg?ic=heart&color=7A0113" width="30" height="30" alt="icon">
              <a class="bouton rouge" href="{{ base }}/enchere/view?id={{enchere.id}}">Faire une offre</a>
            </article>
        {% endfor %}
        </div>
        <div class="bouton blanc">Voir plus</div>
    </section>
</div>
<hr>
<div class="conteneur-principal">
    <section class="grille">
        <div class="groupe-titre">
            <h2>Actualités récentes</h2>
        </div>
        <div class="conteneur">
           {% for enchere in coups_coeur %}
            <article class="carte">
             {% if enchere.coups_de_coeur_du_Lord == 1 %}
                <div class="coup-coeur lord">
                    <p>Coup de coeur du Lord</p>
                </div>
            {% endif %}
                <img src="{{asset}}/img/{{enchere.liens_images}}" alt="Image principale">
                <h3>{{ enchere.nom }}</h3>
                <span>CA${{enchere.prix_plancher}}</span>
                <small>Offres: 3</small>
                <img class="icon" src="https://s2.svgbox.net/hero-outline.svg?ic=heart&color=7A0113" width="30" height="30" alt="icon">
                 <a class="bouton rouge" href="{{ base }}/enchere/view?id={{enchere.id}}">Faire une offre</a>
            </article>
            {% endfor %}
        </div>
       <div class="bouton blanc">Voir plus</div>
    </section>
</div>
<hr>
<section class="infolettre">
        <form class="formulaire" action="#" method="post">
            <h3>Abonnez-vous à notre infolettre</h3>
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom">

            <label for="email">Email</label>
            <input type="email" name="email" id="email">

            <input class="bouton rouge special" type="submit" value="M'inscrire">
        </form>
</section>
{{include ('layouts/footer.php')}}