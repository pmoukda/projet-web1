<?php
namespace App\Controllers;

use App\Models\Timbre;
use App\Models\Condition;
use App\Models\Couleur;
use App\Models\Pays;
use App\Models\Utilisateur;
use App\Providers\View;
use App\Providers\Auth;
use App\Providers\Validator;

class TimbreController{
    
    public function __construct(){
        Auth::session();
    }
    
    public function index(){
        $timbre = new Timbre;
        $timbreSelected = $timbre->select();
        if($timbreSelected){
            return View::render('timbre/index',['timbres'=>$timbreSelected]);
        }
        
    }
    
    public function create(){
        
        $condition = new Condition;
        $selectConditions = $condition->select();
        
        $couleur = new Couleur;
        $selectCouleurs = $couleur->select();
        
        $pays = new Pays;
        $selectPays = $pays->select();
        
        $user = new Utilisateur;
        $selectUserId = $user->selectId($_SESSION['user_id']);;
        
        return View::render('timbre/create', ['conditions' => $selectConditions, 'couleurs' => $selectCouleurs, 'pays' => $selectPays, 'utilisateurs' => $selectUserId]);
        
    } 
    
    public function store($data){
        $validator = new Validator;
        $validator->field('nom', $data['nom'], 'le nom')->min(2)->max(100)->required();
        $validator->field('annee', $data['annee'], "l'année")->validateYear();
        $validator->field('tirage', $data['tirage'], 'le tirage')->number()->bigger(20);
        $validator->field('dimensions', $data['dimensions'])->min(2)->max(45);
        $validator->field('certifie', $data['certifie'], 'certifé')->required();
        $validator->field('condition_id', $data['condition_id'], 'la condition')->required();
        $validator->field('couleur_id', $data['couleur_id'], 'la couleur')->required();
        $validator->field('pays_id', $data['pays_id'], 'le pays')->required();
        // $validator->field('utilisateur_id', $data['utilisateur_id'], "l'utilisateur id")->int();
        $validator->field('description', $data['description'], 'la description')->max(1000);
        
        if($validator->isSuccess()){
            $timbre = new Timbre;
            $insertTimbre = $timbre->insert($data);
            
            if($insertTimbre){
                return View::render('timbre/view');
            }else{
                return View::render('errors',['message' => 'Erreur 404']);
            }

        }else{
            $errors = $validator->getErrors();
            
            $condition = new Condition;
            $selectConditions = $condition->select();
            
            $couleur = new Couleur;
            $selectCouleurs = $couleur->select();
            
            $pays = new Pays;
            $selectPays = $pays->select();
            
            $user = new Condition;
            $selectUsers = $user->select();
            
            return View::render('timbre/create', ['errors' => $errors, 'timbre' => $data, 'conditions' =>  $selectConditions, 'couleurs' => $selectCouleurs, 'pays' => $selectPays, 'utilisateurs' => $selectUsers]);
        }
    }
    
    
    public function view($data){
        if(isset($data['id'])&& $data['id'] != null){
            $timbre = new Timbre;
            $selectedId = $timbre->selectId($data['id']);
            
            if($selectedId){
                $condition_id = $selectedId['condition_id'];
                $condition = new Condition;
                $selectCondition = $condition->selectId($condition_id);
                $conditions = $selectCondition['etat'];
                
                $couleur_id = $selectedId['couleur_id'];
                $couleur = new Couleur;
                $selectCouleur = $couleur->selectId($couleur_id);
                $couleurs = $selectCouleur['couleur'];
                
                $pays_id = $selectedId['pays_id'];
                $pays = new Pays;
                $selectPays = $pays->selectId($pays_id);
                $pays = $selectPays['nom_pays'];
                
                $user_id = $selectedId['utilisateur_id'];
                $user = new Utilisateur;
                $selectUser = $user->selectId($user_id);
                $users = $selectUser['nom_utilisateur'];
                
                return View::render('timbre/view', ['timbre' => $selectedId, 'conditions' => $conditions, 'couleurs' => $couleurs, 'pays' => $pays, 'utilisateur' => $users]);
            }else{
                return View::render('errors',['message' => 'Timbre non trouvé!']);
            }
            
        }else{
            return View::render('errors', ['message' =>'Erreur 404']);
        }
    }
    
    public function edit($data){
        if(isset($data['id'])&& $data['id'] != null){
            $timbre = new Timbre;
            $selectedId = $timbre->selectId($data);
            
            $condition = new Condition;
            $selectConditions = $condition->select();
            
            $couleur = new Couleur;
            $selectCouleurs = $couleur->select();
            
            $pays = new Pays;
            $selectPays = $pays->select();
            
            $user = new Condition;
            $selectUsers = $user->select();
            
            if($selectedId){
                return View::render('timbre/edit', ['timbre' => $selectedId, 'conditions' => $selectConditions, 'couleurs' => $selectCouleurs, 'pays' => $selectPays, 'utilisateurs' => $selectUsers]);
            }else{
                return View::render('errors',['message' => 'Timbre non trouvé!']);
            }
            
        }else{
            return View::render('errors', ['message' =>'Erreur 404']);
        }
    }
    
    public function update($data,$get){
        if(isset($get['id']) && $get['id'] != null){
            $validator = new Validator;
            
            $validator->field('nom', $data['nom'], 'le nom')->min(2)->max(100)->required();
            $validator->field('annee', $data['annee'], "l'année")->validateYear();
            $validator->field('tirage', $data['tirage'], 'le tirage')->number()->bigger(20);
            $validator->field('dimensions', $data['dimensions'])->min(2)->max(45);
            $validator->field('certifie', $data['certifie'], 'certifé')->required();
            $validator->field('condition_id', $data['condition_id'], 'la condition')->required();
            $validator->field('couleur_id', $data['couleur_id'], 'la couleur')->required();
            $validator->field('pays_id', $data['pays_id'], 'le pays')->required();
            // $validator->field('utilisateur_id', $data['utilisateur_id'], "l'utilisateur id")->int()->required();
            $validator->field('description', $data['description'], 'la description')->bigger(1000);
            
            if($validator->isSuccess()){
                $id = $get['id'];
                $timbre = new Timbre;
                $updated = $timbre->update($data, $id );
                
                if($updated){
                    return View::redirect('timbre');
                }else{
                    return View::render('errors',['message' => 'Impossible de faire la mise à jour']);
                }
            }else{
                $errors = $validator->getErrors();
                
                $condition = new Condition;
                $selectConditions = $condition->select();
                
                $couleur = new Couleur;
                $selectCouleurs = $couleur->select();
                
                $pays = new Pays;
                $selectPays = $pays->select();
                
                $user = new Condition;
                $selectUsers = $user->select();
                
                return View::render('timbre/edit', ['errors' => $errors, 'timbre' => $data, 'conditions' =>  $selectConditions, 'couleurs' => $selectCouleurs, 'pays' => $selectPays, 'utilisateurs' => $selectUsers]);
            }
        }else{
            return View::render('errors', ['message' => 'Erreur 404']);
        }
    }
    
    public function delete($data){
        if(Auth::session()){
            $timbre = new Timbre;
            $delete = $timbre->delete($data);
            if($delete){
                return View::render('timbre');
            }else{
                return View::render('errors', ['message' => 'Impossible de supprimer le timbre! Timbre non trouvé.']);
            }
        }
    }
}

?>