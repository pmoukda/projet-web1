<?php
namespace App\Models;

class Favorie_enchere extends CRUD{
    protected $table = 'favorie_enchere' ;
    protected $primaryKey = 'id' ;
    protected $fillable = ['enchere_id', 'utilisateur_id','date_ajout'] ;
}

?>