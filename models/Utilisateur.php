<?php
namespace App\Models;
use App\Models\CRUD;

class Utilisateur extends CRUD{
    protected $table = 'utilisateur';
    protected $primaryKey = 'id';
    protected $fillable = ['nom', 'nom_utilisateur', 'email', 'password','date_creation','adresse', 'phone', 'code_postal', 'privilege_id' => '1', 'ville_id', 'pays_id'];

    public function hashPassword($password, $cost = 10){
        $options = ['cost' => $cost];

        return password_hash($password, PASSWORD_BCRYPT, $options);
    }

    public function checkUser($username, $password){
        $user = $this->unique('nom_utilisateur', $username);

        if($user){
            if(password_verify($password, $user['password'])){
                session_regenerate_id();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nom'];
                $_SESSION['privilege_id'] = $user['privilege_id'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']);
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}



?>