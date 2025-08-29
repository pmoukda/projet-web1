<?php
namespace App\Controllers;
use App\Models\Favorie_enchere;
use App\Providers\Auth;
use App\Providers\View;

class FavorieController{

    public function __construct(){
        Auth::session();
    }
    public function index(){
        if(isset($_SESSION['user_id'])){

            $favorie = new Favorie_enchere;
            $favories = $favorie->selectByField('utilisateur_id',$_SESSION['user_id']);
            // print_r($_SESSION['user_id']);die();

            return View::render('favorie/index', ['favories' =>$favories]);
        }

    }
        public function store($data) {
        if (!isset($_SESSION['user_id'])) {
            return View::render('errors', ['message' => "Utilisateur non connecté"]);
        }

        // Préparer les données à insérer
        $favori = ['utilisateur_id' => $_SESSION['user_id'],'enchere_id' => $data['enchere_id']];
        
        $favorie = new Favorie_enchere;
        $insert = $favorie->insert($favori);

        if ($insert) {
            return View::redirect('favorie/index');
        } else {
            return View::render('errors', ['message' => "Impossible d'ajouter le favori."]);
        }
    }
     public function delete($data){
        if(Auth::session()){
            $favorie = new Favorie_enchere;
            $deleted = $favorie->delete($data['id']);

            if($deleted){
                return View::render('favorie');
            }else{
                return View::render('errors', ['message' => "Impossible de faire la supression!"]);
            }
        }
    }
}


?>