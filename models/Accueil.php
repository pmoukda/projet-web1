<?php
namespace App\Models;
use App\Models\CRUD;

class Accueil extends CRUD{
 
    public function getData(){
        return "Philatélistes et Amateurs, Soyez le bienvenue sur le site palpitant du monde des timbres ! Lord Stampee est enchanté de partager sa plus grande passion avec vous et d'en découvrir également les votres!";
    }

  
}



?>