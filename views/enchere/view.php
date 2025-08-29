{{include('layouts/header.php', {title:'Enchere view'})}}
    <section class="sectionVue">
     <div class="lien-filtre">
            <small class="lien">
                <a href="{{base}}/home">Accueil</a>/<a href="{{base}}/enchere">En cours</a>/<a href="{{base}}/enchere/view?id={{enchere.id}}">{{ pays }}</a>/<a href="{{base}}/enchere">{{conditions}}</a>
            </small>
            <small>ID: {{ encheres.id }}</small>
        </div>
        <div class="conteneur-principal">
                    <div class="caroussel">
                    <div class="zone-image">
                    {% for image in images %}
                        {% if image.image_principale == 1 %}
                            <img class="grande-image" src="{{asset}}/img/{{image.liens_images}}" alt="Image principale">
                        {% endif %}
                    {% endfor %}
                        <div class="fleches-direction">
                            <button class="fleche gauche">🡠</button>
                            <button class="fleche droite">🡢</button>
                        </div>
                    </div>
                    <div class="miniatures">
                     {% for image in images %}
                        <img class="image-petite" src="{{asset}}/img/{{image.liens_images}}" alt="Image secondaire">
                    {% endfor %}
                    </div>
                </div>
                <div class="groupe-fiche">
                    <div class="groupe-titre">
                        <h1 class="h2">{{ timbres.nom }}</h1>
                    </div>
                    <div class="fiche">
                        <div class="onglet" id="onglet_detail">
                            <div class="onglet-entete">
                                <a href="#onglet_detail"class="active">Détail</a>
                                <a href="#onglet_description">Description</a>
                                <a href="#onglet_historique">Historique</a>
                                <a href="#onglet_info_vendeur">Information sur le vendeur</a>
                                <a href="#onglet_livraison">Livraison</a>
                                <a href="#onglet_questions">Questions</a>
                                <a href="#onglet_paiement">Paiement</a>
                            </div>
                            <div class="sous-onglet">
                                <div class="premiere_rangee">
                                {% if derniereMise %}
                                    <p><strong>Enchère actuelle: ${{ derniereMise.prix }}</strong></p>
                                {% else %}
                                    <p><strong>Enchère actuelle: ${{ encheres.prix_plancher }}</strong></p>
                                {% endif %}
                                <p>Offres : {{ nombreOffres }}</p>
                                </div>
                                <div class="deuxieme_rangee">
                                    <div>
                                        <p>Vendeur: {{ utilisateurs }} </p>
                                        <p class="temps">Temps restant: {{temps}} </p>
                                    </div>
                                    <form class="formulaire-fiche" action="{{base}}/mise/store" method="post">
                                        <div>
                                            <p><strong>Enchérir</strong></p>
                                            <label class="invisible" for="prix">Enchère</label>
                                            <input type="number" id="prix" name="prix" step="0.01" placeholder="$CA" value="{{mise.prix ?? '' }}">
                                            {% if errors.prix is defined %}
                                                {% for error in errors %}
                                                    <p class="error">{{ error }}</p>
                                                {% endfor %}
                                            {% endif %}
                                           {% if derniereMise %}
                                                <p>Enchère minimum: ${{ derniereMise.prix }}</p>
                                            {% else %}
                                                <p>Enchère minimum: ${{ encheres.prix_plancher }}</p>
                                            {% endif %}
                                            <input type="hidden" name="enchere_id" value="{{ encheres.id }}">
                                        </div>
                                        <button class="bouton rouge special" type="submit">Enchérir</button>
                                    </form>
                                </div>
                                <div class="troisieme_rangee">
                                    <div>
                                        <img src="https://s2.svgbox.net/payments.svg?ic=paypal&color=000" width="32" height="32" alt="paypal">
                                        <img src="https://s2.svgbox.net/payments.svg?ic=mastercard&color=000" width="32" height="32" alt="mc">
                                        <img src="https://s2.svgbox.net/payments.svg?ic=visa&color=000" width="32" height="32" alt="visa">
                                        <img src="https://s2.svgbox.net/payments.svg?ic=amex&color=000" width="32" height="32" alt="amex">
                                    </div>
                                    <p>Annonce vue 50 fois</p>
                                    <div class="coup-coeur" data-id="{{ encheres.id }}">Ajouter à ma favorie
                                        <img class="icon" src="https://s2.svgbox.net/hero-outline.svg?ic=heart&color=000" width="23" height="23" alt="icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="onglet" id="onglet_description">
                            <div class="onglet-entete">
                                <a href="#onglet_detail">Détail</a>
                                <a href="#onglet_description" class="active">Description</a>
                                <a href="#onglet_historique">Historique</a>
                                <a href="#onglet_info_vendeur">Information sur le vendeur</a>
                                <a href="#onglet_livraison">Livraison</a>
                                <a href="#onglet_questions">Questions</a>
                                <a href="#onglet_paiement">Paiement</a>
                            </div>
                            <div class="sous-onglet">
                                <div class="premiere_rangee">
                                    <p><strong>Description de l&#39article</strong></p>
                                    <p></p>
                                </div>
                                <div class="deuxieme_rangee">
                                    <div>
                                        <p><strong>Pays:</strong> {{ pays }}</p>
                                        <p><strong>Année:</strong> {{ timbres.annee }}</p>
                                        <p><strong>Tirage:</strong> {{ timbres.tirage }}</p>
                                        <p><strong>Dimensions:</strong> {{ timbres.dimensions }}</p>
                                        <p><strong>Condition:</strong> {{ conditions }}</p>
                                        <p><strong>Couleur:</strong> {{ couleurs }}</p>
                                        <p><strong>Certifié:</strong> {{ timbres.certifie == 1 ? 'Oui' : 'Non' }}</p>
                                        <p><strong>Numéro de catalogue:</strong> {{timbres.id}}</p>
                                    </div>
                                    <div>
                                        <p>{{ timbres.description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="onglet" id="onglet_historique">
                            <div class="onglet-entete">
                                <a href="#onglet_detail">Détail</a>
                                <a href="#onglet_description">Description</a>
                                <a href="#onglet_historique" class="active">Historique</a>
                                <a href="#onglet_info_vendeur">Information sur le vendeur</a>
                                <a href="#onglet_livraison">Livraison</a>
                                <a href="#onglet_questions">Questions</a>
                                <a href="#onglet_paiement">Paiement</a>
                            </div>
                            <div class="sous-onglet">
                                <div class="premiere_rangee">
                                    <p><strong>3 offres en cours</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="onglet" id="onglet_info_vendeur">
                            <div class="onglet-entete">
                                <a href="#onglet_detail">Détail</a>
                                <a href="#onglet_description">Description</a>
                                <a href="#onglet_historique">Historique</a>
                                <a href="#onglet_info_vendeur" class="active">Information sur le vendeur</a>
                                <a href="#onglet_livraison">Livraison</a>
                                <a href="#onglet_questions">Questions</a>
                                <a href="#onglet_paiement">Paiement</a>
                            </div>
                            <div class="sous-onglet">
                                <div class="premiere_rangee">
                                    <p><strong>Information sur le vendeur</strong></p>
                                </div>
                                <div class="deuxieme_rangee">
                                    <div>
                                        <p><strong>Vendeur:</strong> {{ utilisateurs }}</p>
                                        <p><strong>Incrit depuis le:</strong> {{createur.date_creation|date('Y-m-d')}}</p>
                                        <p><strong>Reaction:</strong> 100%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="onglet" id="onglet_livraison">
                            <div class="onglet-entete">
                                <a href="#onglet_detail">Détail</a>
                                <a href="#onglet_description">Description</a>
                                <a href="#onglet_historique">Historique</a>
                                <a href="#onglet_info_vendeur">Information sur le vendeur</a>
                                <a href="#onglet_livraison" class="active">Livraison</a>
                                <a href="#onglet_questions">Questions</a>
                                <a href="#onglet_paiement">Paiement</a>
                            </div>
                            <div class="sous-onglet">
                                <div class="premiere_rangee">
                                    <p><strong>Localisation de l&#39article:</strong> {{utilisateur_ville }}, {{ utilisateur_pays }}</p>
                                    <p><strong>Expédition vers:</strong> Dans le monde</p>
                                </div>
                                <div>
                                    <p><strong>Calculateur de frais de port</strong></p>
                                </div>
                                <div class="deuxieme_rangee">
                                    <form class="formulaire-fiche">
                                        <div class="champ">
                                      <label for="pays">Pays</label>
                                        <select name="pays_id" id="pays_id" required>
                                            <option value="">Choisir un pays</option>
                                            {% for pays in pays_listes %}
                                                <option value="{{pays.id}}" {% if pays.id == timbres.pays_id %} selected {% endif %}>{{ pays.nom_pays }}</option>
                                            {% endfor %}
                                        </select>
                                        </div>
        
                                        <div class="champ">
                                            <label for="code-postal">Code postal</label>
                                            <input type="text" id="code-postal" name="code-postal" pattern="^[A-Za-z0-9\- ]{3,10}$" placeholder="Votre code postal">
                                        </div>
                                        <div class="champ">
                                            <label for="quantite">Quantité</label>
                                            <input type="number" id="quantite" name="quantité" min="1" placeholder="1">
                                        </div>
                                    </form>
                                </div>
                                <div class="troisieme_rangee">
                                    <p><strong>Retour accepté</strong>: Oui</p>
                                    <input class="bouton rouge special " type="submit" value="Obtenir les frais d'expédition">
                                </div>
                            </div>
                        </div>
                        <div class="onglet" id="onglet_questions">
                            <div class="onglet-entete">
                                <a href="#onglet_detail">Détail</a>
                                <a href="#onglet_description">Description</a>
                                <a href="#onglet_historique">Historique</a>
                                <a href="#onglet_info_vendeur">Information sur le vendeur</a>
                                <a href="#onglet_livraison">Livraison</a>
                                <a href="#onglet_questions" class="active">Questions</a>
                                <a href="#onglet_paiement">Paiement</a>
                            </div>
                            <div class="sous-onglet">
                                <div class="premiere_rangee">
                                    <p><strong>Questions publiques</strong></p>
                                </div>
                                <div class="deuxieme_rangee">
                                    <div>
                                        <p>Il n&#39y a pas de messages postés.</p>
                                        <p>Vous devez être connecté pour poser une question au vendeur.</p>
                                    </div>
                                </div>
                                <div class="troisieme_rangee">
                                    <a href="{{base}}/login">Cliquez ici pour vous connecter</a>
                                </div>
                            </div>
                        </div>
                        <div class="onglet" id="onglet_paiement">
                            <div class="onglet-entete">
                                <a href="#onglet_detail">Détail</a>
                                <a href="#onglet_description">Description</a>
                                <a href="#onglet_historique">Historique</a>
                                <a href="#onglet_info_vendeur">Information sur le vendeur</a>
                                <a href="#onglet_livraison">Livraison</a>
                                <a href="#onglet_questions">Questions</a>
                                <a href="#onglet_paiement" class="active">Paiement</a>
                            </div>
                            <div class="sous-onglet">
                                <div class="premiere_rangee">
                                    <p><strong>Méthode de paiement</strong></p>
                                    <div>
                                        <img src="https://s2.svgbox.net/payments.svg?ic=paypal&color=000" width="32" height="32" alt="paypal">
                                        <img src="https://s2.svgbox.net/payments.svg?ic=mastercard&color=000" width="32" height="32" alt="mc">
                                        <img src="https://s2.svgbox.net/payments.svg?ic=visa&color=000" width="32" height="32" alt="visa">
                                        <img src="https://s2.svgbox.net/payments.svg?ic=amex&color=000" width="32" height="32" alt="amex">
                                    </div>
                                </div>
                                <div class="deuxieme_rangee">
                                    <div>
                                        <p><strong>Condition de paiement</strong></p>
                                        <p>Tous les paiements se font par le site Lord Stampee. En fonction des possibilités proposées par le vendeur, vous pouvez utiliser PayPal, ajouter une carte de crédit/débit ou faire un virement vers votre solde. Aucun paiement n’est réalisé par chèque ou virement bancaire direct au vendeur.</p>
                                        <p>L&#39acheteur utilise les moyens de paiement disponibles sur Lord Stampee dans la page " Mon profil : À payer".</p>
                                        <p>Un paiement ne passant pas par le système de paiement integré au site sera remboursé par le vendeur à l&#39acheteur. Un achat non payé peut entraîner des conséquences au niveau du compte de l’acheteur.</p>
                                        <p>Les achats doivent être payés dans les 14 jours suivant la réception du décompte final de la part du vendeur.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
     <section class="plus-article">
            <h2 class=" h3 groupe-titre">Plus d&#39article provenant du vendeur {{utilisateurs}}</h2>
            <div class="conteneur-petite-carte">
            {% for enchere in liste_encheres %}
                <article class="carte petite">
                    {% for image in images %}
                        {% if image.timbre_id == enchere.id and image.image_principale == 1 %}
                            <img class="grande-image" src="{{asset}}/img/{{image.liens_images}}" alt="Image principale">
                        {% endif %}
                    {% endfor %}   
                    <h3 class="h4">{{ enchere.nom }}</h3>
                    <span>CA${{ enchere.prix_plancher}}</span>
                    <small>Offres: 2</small>
                    <img class="icon" src="https://s2.svgbox.net/hero-outline.svg?ic=heart&color=7A0113" width="30" height="30" alt="icon">
                    <a class="bouton rouge" href="{{base}}/enchere/view?id={{ encheres.id }}">Faire une offre</a>
                </article>
            {% endfor %}
            </div>
            <a class="bouton blanc" href="#">Voir plus</a>
        </section>
{{include('layouts/footer.php')}}