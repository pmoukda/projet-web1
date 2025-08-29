<?php
namespace App\Controllers;
use App\Models\Enchere;
use App\Models\Images;
use App\Models\Timbre;
use App\Models\Pays;
use App\Models\Couleur;
use App\Models\Condition;
use App\Models\Utilisateur;
use App\Models\Ville;
use App\Models\Mise;
use App\Providers\View;

class EnchereController{

    public function index() {

    // Récupérer les filtres,si aucun filtre : afficher actives par défaut
    if (isset($_GET['filtre'])) {
    $filtre = $_GET['filtre'];
    } else {
        $filtre = 'actives';
    }

    $enchere = new Enchere;
    $mise = new Mise;
    
    if (!is_array($filtre)) {
        $filtre = [$filtre];
    }

    // Créer une seule liste à afficher
    $encheres = [];

   if (in_array('actives', $filtre)) {
        $actives = $enchere->selectActives();

        // Ajouter le nombre d'offres à chaque enchère active
        foreach ($actives as $enchereActives) {
            $enchereActives['nombreOffres'] = $mise->countByField('enchere_id', $enchereActives['id']);
        }

        $encheres = array_merge($encheres, $actives);
    }

    // Sélectionner les enchères archivées
    if (in_array('archivees', $filtre)) {
        $archivees = $enchere->selectArchivees();

        // Ajouter le nombre d'offres à chaque enchère archivée
        foreach ($archivees as $enchereArchivees) {
            $enchereArchivees['nombreOffres'] = $mise->countByField('enchere_id', $enchereArchivees['id']);
        }

        $encheres = array_merge($encheres, $archivees);
    }
    
    // compter les enchères disponibles
    $totalActives = count($enchere->selectActives());
    $totalArchivees = count($enchere->selectArchivees());


    return View::render('enchere/index', ['encheres' => $encheres,'filtres' => $filtre, 'total_actives' => $totalActives,
        'total_archivees' => $totalArchivees]);
    }


    
    public function view($data){
        if(isset($_GET['id']) && $_GET['id'] != null){
            $enchere = new Enchere;
            $selectedId = $enchere->selectId($data['id']);

            if($selectedId){
                $timbre_id = $selectedId['timbre_id'];
                $timbre = new Timbre;
                $selectTimbre = $timbre->selectId($timbre_id);
                // print_r($selectTimbre); die();

                $image = new Images;
                $imagesSelected = $image->selectByField('timbre_id', $timbre_id);
                // print_r($imagesSelected); die();

                $condition_id = $selectTimbre['condition_id'];
                $condition = new Condition;
                $selectCondition = $condition->selectId($condition_id);
                $conditions = $selectCondition['etat'];
                
                $couleur_id = $selectTimbre['couleur_id'];
                $couleur = new Couleur;
                $selectCouleur = $couleur->selectId($couleur_id);
                $couleurs = $selectCouleur['couleur'];
                
                $pays_id = $selectTimbre['pays_id'];
                $pays = new Pays;
                $selectPays = $pays->selectId($pays_id);
                $pays = $selectPays['nom_pays'];
                
                $user_id = $selectTimbre['utilisateur_id'];
                $user = new Utilisateur;
                $selectUser = $user->selectId($user_id);
                $users = $selectUser['nom_utilisateur'];
                // print_r($user_id); die();

                // Afficher le pays de l'utilisateur dans la section livraison
                $users_pays = $selectUser['pays_id'];
                $pays_u = new Pays;
                $user_pays = $pays_u->selectId($users_pays);
                $pays_user = $user_pays['nom_pays'];

                // Afficher la ville de l'utilisateur dans la section livraison
                $users_ville = $selectUser['ville_id'];
                $ville_u = new Ville;
                $user_villes = $ville_u->selectId($users_ville);
                $ville_user = $user_villes['nom_ville'];
                
                // faire afficher la lites des pays dans la section livraison
                $pays_liste = new Pays;
                $pays_listes = $pays_liste->select();

                // Calculer le temps restant des enchères
                date_default_timezone_set('America/Toronto');
                $now = new \DateTime;
                $dateFin = new \DateTime($selectedId['date_fin']);
                // print_r($dateFin);
                // die();

                $interval = $now->diff($dateFin);

                if ($now < $dateFin) {
                    $tempsRestant = $interval->format('%a jours, %h heures, %i minutes');
                } else {
                    $tempsRestant = 'Enchère terminé';
                }

                // Afficher la liste des enchères du vendeur
                    $liste_enchere = new Timbre;
                    $liste_encheres = $liste_enchere->selectByField('utilisateur_id', $user_id);
                // print_r($liste_encheres); die();
             
                $mise = new Mise;
                $mises = $mise->selectByField('enchere_id', $selectedId['id']);


                return View::render('enchere/view' ,['encheres' => $selectedId, 'timbres' => $selectTimbre, 'images' =>$imagesSelected, 'conditions' => $conditions, 'couleurs' => $couleurs, 'pays' => $pays, 'utilisateurs' => $users, 'pays_listes' => $pays_listes, 'utilisateur_pays' => $pays_user, 'utilisateur_ville' => $ville_user, 'createur' => $selectUser, 'temps' => $tempsRestant, 'liste_encheres' => $liste_encheres, 'mises' => $mises]);
                
            }else{
                return View::render('errors', ['message' => "Impossible d'afficher les enchères."]);
            }
            
        }else{
            return View::render('errors', ['message' => 'Erreur 404']);
        }
    }
    
}

?>