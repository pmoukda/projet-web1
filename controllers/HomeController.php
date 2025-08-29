<?php
namespace App\Controllers;
use App\Models\Accueil;
use App\Models\Enchere;
use App\Providers\View;


class HomeController{
    public function index(){
       $model = new Accueil;
       $data = $model->getData();

       $enchere = new Enchere;
       $encheres = $enchere->selectTimbreEtImage();

       $coupCoeur = $enchere->selectCoupsCoeur();

       return View::render('home', ['data'=>$data, 'encheres' => $encheres, 'coups_coeur' => $coupCoeur]);
    }
}

?>