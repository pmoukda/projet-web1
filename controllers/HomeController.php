<?php
namespace App\Controllers;
use App\Models\Accueil;
use App\Providers\View;

class HomeController{
    public function index(){
       $model = new Accueil;
       $data = $model->getData();

       return View::render('home', ['data'=>$data]);
    }
}

?>