<?php
namespace App\Models;
use App\Models\CRUD;

class Accueil extends CRUD{
 
    public function getData(){
        return "Philatélistes et Amateurs, Soyez le bienvenue sur le site palpitant du monde des timbres ! ";
    }

}



?>