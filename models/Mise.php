<?php
namespace App\Models;
use App\Models\CRUD;

class Mise extends CRUD{
    protected $table = 'mise' ;
    protected $primaryKey = 'id' ;
    protected $fillable = ['prix', 'date', 'enchere_id', 'utilisateur_id'] ;


    // Méthode pour compter le nombre d'offres pour une enchère 
public function countByField($field, $value) {
    $sql = "SELECT COUNT(*) FROM $this->table WHERE $field = :value";

    $stmt = $this->prepare($sql);
    $stmt->bindParam(':value', $value);
    $stmt->execute();

    $result = $stmt->fetchColumn();

    return $result;
}


}

?>