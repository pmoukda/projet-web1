<?php

namespace App\Controllers;

use App\Models\Privilege;
use App\Models\Utilisateur;
use App\Models\Ville;
use App\Models\Pays;
use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;

class UtilisateurController{

    public function index(){
        Auth::session();
        $user = new Utilisateur;
        $user = $user->select();

        $privilege = new Privilege;
        $privileges = $privilege->selectAssoc('id','role');

        $ville = new Ville;
        $villes = $ville->selectAssoc('id', 'nom_ville');

        $pays = new Pays;
        $pays = $pays->selectAssoc('id', 'nom_pays');
        
        return View::render('utilisateur/index',['utilisateurs'=>$user, 'privileges' => $privileges, 'villes' => $villes, 'pays' => $pays]);
    }
    
    public function create(){
        $ville = new Ville;
        $villes = $ville->select();
        
        $pays = new Pays;
        $pays = $pays->select();
        
        $privilege = new Privilege;
        $privileges = $privilege->select();
        
        return View::render('utilisateur/create', ['villes' => $villes, 'pays' => $pays, 'privileges' => $privileges]);
        
    }
    public function store($data){
        $validator = new Validator;
        $validator->field('nom', $data['nom'], 'le nom')->min(2)->max(45);
        $validator->field('nom_utilisateur', $data['nom_utilisateur'], "le nom d'utilisateur")->min(2)->max(45)->email()->unique('Utilisateur')->required();
        $validator->field('email', $data['email'], 'courriel')->min(2)->max(45)->email()->unique('Utilisateur')->required();
        $validator->field('password', $data['password'],'le mot de passe')->min(8)->max(20)->required();
        $validator->field('adresse', $data['adresse'],"l'adresse")->required();
        $validator->field('phone', $data['phone'],'le téléphone')->number();
        $validator->field('code_postal', $data['code_postal'], 'le code postal')->required();
        // $validator->field('privilege_id', $data['privilege_id'], 'le privilege')->required;
        $validator->field('ville_id', $data['ville_id'], 'la ville')->required();
        $validator->field('pays_id', $data['pays_id'], 'le pays')->required();
      
        
        if($validator->isSuccess()){
            $user = new Utilisateur;
            $data['password'] = $user->hashPassword($data['password']);
            $insertUser = $user->insert($data);
            if($insertUser){
                return View::redirect('login');
            }
            
        }else{
            $errors = $validator->getErrors();
            $ville = new Ville;
            $villes = $ville->select();
            
            $pays = new Pays;
            $pays = $pays->select();
            
            $privilege = new Privilege;
            $privileges = $privilege->select();
            
            return View::render('utilisateur/create', ['errors' => $errors, 'utilisateur' => $data, 'villes' => $villes, 'pays' => $pays, 'privileges' => $privileges]);
        }
        
    }
    
    public function edit($data){
        Auth::session();
        
        if(isset($data['id']) && $data['id'] != null){
            $user = new Utilisateur;
            $selectedId = $user->selectId($data['id']);
            
            $ville = new Ville;
            $villes = $ville->select();
            
            $pays = new Pays;
            $pays = $pays->select();
            
            $privilege = new Privilege;
            $privileges = $privilege->select();
            
            if($selectedId){
                return View::render('utilisateur/edit',['utilisateur' => $selectedId, 'villes' => $villes, 'pays' => $pays, 'privileges' => $privileges]);
            }else{
                return View::render('errors', ['message' => 'Utilisateur non trouvé!']);
            }
            
        }else{
            return View::render('errors', ['message' => 'Erreur 404, page introuvable!']);
        }
    }
    
    public function update($data, $get){
        Auth::session();

        if(isset($get['id']) && $get['id'] != null){
            $user = new Utilisateur;
            $existingUser = $user->selectId($get['id']);

            if (!$existingUser) {
                return View::render('error', ['message' => 'Utilisateur non trouver.']);
            }
            $validator = new Validator;
            $validator->field('nom', $data['nom'], 'le nom')->min(2)->max(45);

            if ($data['nom_utilisateur'] !== $existingUser['nom_utilisateur']) {
                $validator->field("nom_utilisateur", $data['nom_utilisateur'],"le nom d'utilisateur")->min(2)->max(45)->email()->unique('Utilisateur');
            } else {
                $validator->field('nom_utilisateur', $data['nom_utilisateur'], "le nom d'utilisateur")->min(2)->max(45)->email();
            }

            if ($data['email'] !== $existingUser['email']) {
                $validator->field('email', $data['email'], "courriel")->min(2)->max(45)->email()->unique('Utilisateur')->required();
            
            } else {
                $validator->field('email', $data['email'], "courriel")->min(2)->max(45)->email();
            }

           if (!empty($data['password'])) {
                $validator->field('password', $data['password'], "le mot de passe")->min(8)->max(25);
                $data['password'] = $user->hashPassword($data['password']);
            } else {
                unset($data['password']);
            }

            $validator->field('adresse', $data['adresse'],"l'adresse")->required();
            $validator->field('phone', $data['phone'], "le téléphone")->number()->max(20);
            $validator->field('code_postal', $data['code_postal'], "le code postal")->required();
            // $validator->field('privilege_id', $data['privilege_id'],'le privilege')->required;
            $validator->field('ville_id', $data['ville_id'], "la ville")->required();
            $validator->field('pays_id', $data['pays_id'], "le pays")->required();

            if($validator->isSuccess()){
                $updated = $user->update($data, $get['id']);

                if($updated){
                    return View::redirect('utilisateur/view?id=' . $get['id']);
                }else{
                    return View::render('errors', ['message' => "Impossible de faire la mise à jour de l'utilisateur"]);
                }

            }else{
                $errors = $validator->getErrors();

                $ville = new Ville;
                $villes = $ville->select();

                $pays = new Pays;
                $pays = $pays->select();
                
                $privilege = new Privilege;
                $privileges = $privilege->select();

                return View::render('utilisateur/edit', ['errors' => $errors, 'utilisateur' => $data, 'villes' => $villes, 'pays' => $pays, 'privileges' => $privileges]);
            }
        }else{
            return View::render('errors', ['message' => "Erreur 404. Page introuvable!" ]);
        }

    }
    public function view($data){
        Auth::session();
        
        if(isset($data['id']) && $data['id'] != null){
            $user = new Utilisateur;
            $selectId = $user->selectId($data['id']);
            // print_r($selectId);
            if($selectId){
                $ville_id = $selectId['ville_id'];
                $ville = new Ville;
                $villeSelected = $ville->selectId($ville_id);
                $villes = $villeSelected['nom_ville'];
                
                $pays_id = $selectId['pays_id'];
                $pays = new Pays;
                $paysSelected = $pays->selectId($pays_id);
                $pays = $paysSelected['nom_pays'];
                
                $privilege_id = $selectId['privilege_id'];
                $privilege = new Privilege;
                $privileges = $privilege->selectId($privilege_id) ;
                
                
                return View::render('utilisateur/view', ['utilisateur' => $selectId, 'ville' => $villes, 'pays' => $pays, 'privilege' => $privileges]);
                
            }else{
                return View::render('errors',['message' => 'Utilisateur non trouvé!']);
            }
            
        }else{
            return View::render('errors', ['message' => 'Erreur 404, page introuvable!']);
        }
    }
    public function delete($data){
        if(Auth::session()){
            $user = new Utilisateur;
            $deleted = $user->delete($data['id']);

            if($deleted){
                return View::render('utilisateur/create');
            }else{
                return View::render('errors', ['message' => "Impossible de faire la supression! Cet utilisateur n'existe pas."]);
            }
        }
    }
    
}