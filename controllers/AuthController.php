<?php
namespace App\Controllers;

use App\Models\Utilisateur;
use App\Providers\View;
use App\Providers\Validator;

class AuthController{

    public function index(){
        return View::render('auth/index');
    }
    public function store($data){
        $validator = new Validator;
        $validator->field("nom_utilisateur",$data['nom_utilisateur'], "le nom d'utilisateur")->min(2)->max(45)->email();
        $validator->field('password',$data['password'], "le mot de passe")->min(8)->max(25);

        if($validator->isSuccess()){
            $user = new Utilisateur;
            $checkuser = $user->checkUser($data['nom_utilisateur'], $data['password']);

            if($checkuser){
                return View::redirect('utilisateur/view?id=' . $_SESSION['user_id']);
            }else{
                $errors['message'] = "Veuillez vérifier vos identifiants !";
                return View::render('auth/index', ['errors' => $errors]);
            }

        }else{
            $errors = $validator->getErrors();
            return View::render('auth/index', ['errors' => $errors]);
        }
    }
    public function delete(){
        session_destroy();
        return View::redirect('login');
    }
}


?>