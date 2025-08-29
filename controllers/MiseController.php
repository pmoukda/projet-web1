<?php
namespace App\Controllers;

use App\Models\Mise;
use App\Models\Enchere;
use App\Models\Images;
use App\Models\Timbre;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class MiseController {
    public function __construct(){
        Auth::session();
    }
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            return View::render('errors', ['message' => "Veuillez vous connecter."]);
        }
        
        $userId = $_SESSION['user_id'];
        $miseModel = new Mise();
        $encheresModel = new Enchere();
        $timbreModel = new Timbre();
        
        $mises = $miseModel->selectByField('utilisateur_id', $userId);
        
        foreach ($mises as &$mise) {
            // Ajouter les infos de l’enchère
            $enchere = $encheresModel->selectId($mise['enchere_id']);
            $mise['enchere'] = $enchere;
            
            // Ajouter les infos du timbre
            if ($enchere) {
                $timbre = $timbreModel->selectId($enchere['timbre_id']);
                $mise['timbre'] = $timbre;
            }
        }
        
        return View::render('mise/index', ['mises' => $mises]);
    }
    
    
    public function store($data) {
        // Assurer que l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            return View::render('errors', ['message' => "Utilisateur non connecté."]);
        }
        
        $utilisateur_id = $_SESSION['user_id'];
        
        // Vérifier que l'enchère est ciblée
        if (!isset($data['enchere_id'])) {
            return View::render('errors', ['message' => "ID de l'enchère manquant."]);
        }
        
        $enchere = new Enchere;
        $selectEnchere = $enchere->selectId($data['enchere_id']);
        
        $mise = new Mise;
        $derniereMise = $mise->selectId($data['enchere_id']);
        
        // Déterminer le montant minimum requis
        if($derniereMise){
            $montantMinimum =  $derniereMise['prix'];
        }else{
            $montantMinimum =  $selectEnchere['prix_plancher'];
        }
        // Pour obtenir le nombre d'offres
        $nombreOffres = $mise->countByField('enchere_id', $selectEnchere['id']); 
        // print_r($selectEnchere['id']); die();
        
        // Valider le prix soumis
        $validator = new Validator;
        $validator->field('prix', $data['prix'], 'le prix')->float()->lower($montantMinimum);
        
        if ($validator->isSuccess()) {
            $data['utilisateur_id'] = $utilisateur_id;
            
            $insertMise = $mise->insert($data);
            
            if ($insertMise) {
                $enchere->update(['prix_plancher' => $data['prix']], $data['enchere_id']);
                
                return View::redirect('enchere/view?id=' . $data['enchere_id']);
            } else {
                return View::render('errors', ['message' => "Impossible d'insérer la mise."]);
            }
        } else {
            
            $errors = $validator->getErrors();
            
            $timbre = new Timbre;
            $timbres = $timbre->selectId($selectEnchere['timbre_id']);
            
            $image = new Images;
            $images = $image->selectByField('timbre_id', $timbres['id']);
            
            $mises = $mise->selectByField('enchere_id', $selectEnchere['id']);
            
            
            return View::render('enchere/view', ['errors' => $errors, 'mise' => $data,'encheres' => $selectEnchere, 'images' =>$images, 'mises' =>$mises, 'nombreOffres' =>$nombreOffres]);
        }
    }
      
}



?>