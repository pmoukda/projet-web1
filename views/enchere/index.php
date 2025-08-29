{{include('layouts/header.php', {title:'Enchère index'})}}
     <div class="conteneur-principal">
            <section class="grille">
                <div class="groupe-titre">
                    <h2>Timbres par pays</h2>
                    <div class="coup-coeur">Suivre cette recherche<img class="icon" src="https://s2.svgbox.net/hero-outline.svg?ic=heart&color=000" width="25" height="25" alt="icon"></div>
                </div>
                <div class="conteneur">
                {% for enchere in encheres %}
                    <article class="carte">
                    {% if enchere.coups_de_coeur_du_Lord == 1 %}
                        <div class="coup-coeur lord">
                            <p>Coup coeur du Lord</p>
                        </div>
                    {% endif %}
                        <img src="{{asset}}/img/{{enchere.liens_images}}" alt="Image principale du timbre">
                        <h3>{{enchere.nom}}</h3>
                        <span> ${{enchere.prix_plancher}}</span>
                        <small> Offre: {{ enchere.nombreOffres }}</small>
                        <img class="icon" src="https://s2.svgbox.net/hero-outline.svg?ic=heart&color=7A0113" width="30" height="30" alt="icon">
                        {% if 'actives' in filtres %}
                        <a class="bouton rouge" href="{{base}}/enchere/view?id={{enchere.id}}">Faire une offre</a>
                        {% else %}
                            <span class="inactif">Enchère terminée</span>
                        {% endif %}
                    </article>
                {% endfor %}  
                </div>
                <div class="bouton blanc">Voir plus</div>
            </section>
            <aside class="filtres">
                <h3>Catégories</h3>
                <form action="#" method="POST">
                    <Section class="categorie">
                        <h4 class="categorie-titre">Enchères</h4>
                  
                        <label for="enCours">
                            <input type="checkbox" id="enCours" name="filtres[]" value="actives" {% if 'actives' in filtres %} checked {% endif %}>
                            En cours
                            <small>( {{total_actives}} )</small>
                        </label>
                   
                        <label for="archive">
                            <input type="checkbox" id="archive" name="filtres[]" value="archivees" {% if 'archivees' in filtres %} checked {% endif %}>
                            Archivées
                            <small>( {{total_archivees}} )</small>
                        </label>
        
                    </Section>
                    <section class="categorie">
                        <h4 class="categorie-titre">Pays</h4>
                        <label class="invisible" for="pays">Pays</label>
                        <select name="pays" id="pays">
                            <option value="">Tous pays</option>
                            <option value="1">Angleterre</option>
                            <option value="6">Bahamas</option>
                            <option value="2">Canada</option>
                            <option value="3">Chine</option>
                            <option value="4">États-Unis</option>
                            <option value="5">France</option>
                            <option value="7">Japon</option>
                            <option value="8">Nouvelle-Guinée</option>
                            <option value="9">Nouvelle-Zélande</option>
                            <option value="10">Suisse</option>
                            <option value="11">Australie</option>
                        </select>
                    </section>
                    <section class="categorie">
                        <h4 class="categorie-titre">Prix</h4>
                        <label class="invisible" for="prixDe">$</label>
                        <input type="text" id="prixDe" name="prixDe" placeholder=" $ De">
                        <label class="invisible" for="prixA">$</label>
                        <input type="text" id="prixA" name="prixA" placeholder=" $ À">
                    </section>
                    <section class="categorie">
                        <h4 class="categorie-titre">Année</h4>
                        <label class="invisible" for="anneeDe">De</label>
                        <input type="text" id="anneeDe" name="anneeDe" placeholder="De">
                        <label class="invisible" for="anneeA">À</label>
                        <input type="text" id="anneeA" name="anneeA" placeholder="À">
                    </section>
                    <Section class="categorie">
                        <h4 class="categorie-titre">Condition</h4>
                        <label for="parfait">
                            <input type="checkbox" id="parfait" name="parfait">
                            Parfait
                            <small> ( 100 )</small>
                        </label>
                        <label for="excellente">
                            <input type="checkbox" id="excellente" name="excellente">
                            Excellente
                            <small> ( 500 )</small>
                        </label>
                        <label for="bonne">
                            <input type="checkbox" id="bonne" name="bonne">
                            Bonne
                            <small> ( 200 )</small>
                        </label>
                        <label for="moyenne">
                            <input type="checkbox" id="moyenne" name="moyenne">
                            Moyenne
                            <small> ( 340 )</small>
                        </label>
                        <label for="endommage">
                            <input type="checkbox" id="endommage" name="endommage">
                            Endommagée
                            <small> ( 50 )</small>
                        </label>
                    </Section>
                    <Section class="categorie">
                        <h4 class="categorie-titre">Certifié</h4>
                        <label for="certifieOui">
                            <input type="checkbox" id="certifieOui" name="certifieOui">
                            Oui
                            <small> ( 100 )</small>
                        </label>
                        <label for="certifieNon">
                            <input type="checkbox" id="certifieNon" name="certifieNon">
                            Non
                            <small> ( 1090  )</small>
                        </label>
                    </Section>
                    <input class="bouton" type="submit" value="Rechercher">
                </form>
            </aside>
        </div>
    </main>
{{include('layouts/footer.php')}}