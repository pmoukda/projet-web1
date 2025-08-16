<?php
namespace App\Providers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use App\Models\Utilisateur;

class View {
    static public function render($template, $data = []){
        $loader = new FilesystemLoader('views');
        $twig = new Environment($loader);
        $twig->addGlobal('asset', ASSET);
        $twig->addGlobal('base', BASE);

        if(isset($_SESSION['fingerPrint']) AND $_SESSION['fingerPrint'] == md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'])){
            $guest = false;
            
      // Récupérer l'utilisateur connecté
            if(isset($_SESSION['user_id'])){
                $userModel = new Utilisateur;
                $utilisateur = $userModel->selectId($_SESSION['user_id']);
            } else {
                $utilisateur = null;
            }
        } else {
            $guest = true;
            $utilisateur = null;
        }

        $twig->addGlobal('guest', $guest);
        $twig->addGlobal('session', $_SESSION);
        $twig->addGlobal('utilisateur', $utilisateur);
        echo $twig->render($template.".php", $data);
    }

    static public function redirect($url){
        header('location:'.BASE.'/'.$url);
    }
}

?>