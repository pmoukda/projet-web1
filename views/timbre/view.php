{{include('layouts/header.php', {title:'Timbre view'})}}
    <section class="sectionVue">
        <p class="salutation">Bonjour <strong>{{utilisateur.nom}} !</strong></p>
        <h1>Détails du timbre</h1>
        <div class="conteneur-principal">
                    <div class="caroussel">
                    <div class="zone-image">
                    {% for image in images %}
                        {% if image.image_principale == 1 %}
                            <img class="grande-image" src="{{asset}}/img/{{image.liens_images}}" alt="{{image.liens_images}}">
                        {% endif %}
                    {% endfor %}
                        <div class="fleches-direction">
                            <button class="fleche gauche">🡠</button>
                            <button class="fleche droite">🡢</button>
                        </div>
                    </div>
                    <div class="miniatures">
                     {% for image in images %}
                        <img class="image-petite" src="{{asset}}/img/{{image.liens_images}}" alt="{{image.liens_images}}">
                    {% endfor %}
                    </div>
                </div>
                <div class="groupe-fiche">
                    <div class="groupe-titre">
                        <h1 class="h2">{{ timbre.nom }}</h1>
                    </div>
                    <div class="fiche">
                        <div class="onglet" id="onglet_detail">
                            <div class="onglet-entete">
                                <a href="#onglet_detail" class="active">Détail</a>
                                <a href="#onglet_description">Description</a>
                                <a href="#onglet_historique">Historique</a>
                                <a href="#onglet_info_vendeur">Information sur le vendeur</a>
                                <a href="#onglet_livraison">Livraison</a>
                                <a href="#onglet_questions">Questions</a>
                                <a href="#onglet_paiement">Paiement</a>
                            </div>
                            <div class="sous-onglet">
                                <div class="premiere_rangee">
                                    <p><strong>Enchère actuelle: $15.75 </strong></p>
                                    <p>Offres: 3</p>
                                </div>
                                <div class="deuxieme_rangee">
                                    <div>
                                        <p>Vendeur: {{ utilisateur }}</p>
                                        <p class="temps">Temps restant: 8h 20m </p>
                                    </div>
                                    <div>
                                        <p><strong>Enchérir</strong></p>
                                        <label class="invisible" for="enchere">Enchere</label>
                                        <input type="text" id="enchere" name="enchere" placeholder="$CA">
                                        <p>Enchère minimum: $15.75</p>
                                    </div>
                                    <button class="bouton rouge special">Faire une offre</button>
                                </div>
                                <div class="troisieme_rangee">
                                    <div>
                                        <img src="https://s2.svgbox.net/payments.svg?ic=paypal&color=000" width="32" height="32" alt="paypal">
                                        <img src="https://s2.svgbox.net/payments.svg?ic=mastercard&color=000" width="32" height="32" alt="mc">
                                        <img src="https://s2.svgbox.net/payments.svg?ic=visa&color=000" width="32" height="32" alt="visa">
                                        <img src="https://s2.svgbox.net/payments.svg?ic=amex&color=000" width="32" height="32" alt="amex">
                                    </div>
                                    <p>Annonce vue 50 fois</p>
                                    <div class="coup-coeur">Ajouter à ma favorie
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
                                        <p><strong>Année:</strong> {{ timbre.annee }}</p>
                                        <p><strong>Tirage:</strong> {{ timbre.tirage }}</p>
                                        <p><strong>Dimensions:</strong> {{ timbre.dimensions }}</p>
                                        <p><strong>Condition:</strong> {{ conditions }}</p>
                                        <p><strong>Couleur:</strong> {{ couleurs }}</p>
                                        <p><strong>Certifié:</strong> {{ timbre.certifie == 1 ? 'Oui' : 'Non' }}</p>
                                        <p><strong>Numéro de catalogue:</strong> {{timbre.id}}</p>
                                    </div>
                                    <div>
                                        <p>{{ timbre.description }}</p>
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
                                        <p><strong>Vendeur:</strong> {{ utilisateur }}</p>
                                        <p><strong>Incrit depuis le:</strong> 20-05-2016</p>
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
                                    <p><strong>Localisation de l&#39article:</strong> Montréal, Canada</p>
                                    <p><strong>Expédition vers:</strong> Dans le monde</p>
                                </div>
                                <div>
                                    <p><strong>Calculateur de frais de port</strong></p>
                                </div>
                                <div class="deuxieme_rangee">
                                    <form class="formulaire-fiche">
                                        <div class="champ">
                                            <label for="pays">Sélectionner un pays</label>
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
             <div class="profil_liens">
                <a href="{{ base }}/timbre/edit?id={{ timbre.id }}" class="bouton jaune ">Modifier</a>
                <form method="POST" action="{{ base }}/timbre/delete">
                    <input type="hidden" name="id" value="{{ timbre.id }}">
                    <button type="submit" id="bouton-supprimer" class="bouton rouge">Supprimer</button>
                </form>
                {% for image in images %}
                    <a class="bouton" href="{{ base }}/images/view?id={{ image.id }}">Voir image</a>
                {% endfor %}
                <a class="bouton blanc" href="{{base}}/images/create">Ajouter des images</a>
                <a class="bouton blanc" href="{{base}}/timbre">Retour à la liste</a>
                <a class="bouton blanc" href="{{base}}/utilisateur/view?id={{timbre.utilisateur_id}}">Retour au profil membre</a>
            </div>
    </section>
{{include('layouts/footer.php')}}