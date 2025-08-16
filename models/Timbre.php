<?php
namespace App\Models;
use App\Models\CRUD;

class Timbre extends CRUD{
    protected $table = "timbre";
    protected $primaryKey = "id";
    protected $fillable = ['nom', 'annee', 'date_creation','tirage', 'dimensions', 'certifie', 'condition_id', 'couleur_id', 'pays_id', 'utilisateur_id', 'description'];
}
?>