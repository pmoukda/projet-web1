<?php
namespace App\Models;
use App\Models\CRUD;

class Enchere extends CRUD{
    protected $table = 'enchere' ;
    protected $primaryKey = 'id' ;
    protected $fillable = ['prix_plancher', 'coups_de_coeur_du_Lord', 'date_debut', 'date_fin', 'timbre_id'] ;
    

    public function selectTimbreEtImage() {
        $sql = "SELECT 
                enchere.*,
                timbre.nom,
                images.image_principale, images.liens_images
            FROM $this->table
            JOIN timbre ON $this->table.timbre_id = timbre.id
            LEFT JOIN images ON timbre.id = images.timbre_id
            AND images.image_principale = 1
            WHERE $this->table.date_fin >= NOW()
            limit 5 "; 
        
        $stmt = $this->query($sql);
        if($stmt = $this->query($sql)){
            return $stmt->fetchAll();
        }else{
            return false;
        }
    }
    public function selectCoupsCoeur() {
        $sql = "SELECT 
                enchere.*,
                timbre.nom,
                images.image_principale, images.liens_images
            FROM $this->table
            JOIN timbre ON $this->table.timbre_id = timbre.id
            LEFT JOIN images ON timbre.id = images.timbre_id
            AND images.image_principale = 1
            WHERE $this->table.date_fin >= NOW()
            And coups_de_coeur_du_Lord = 1 limit 5 "; 
        
        $stmt = $this->query($sql);
        if($stmt = $this->query($sql)){
            return $stmt->fetchAll();
        }else{
            return false;
        }
    }


    public function selectArchivees() {
    $sql = "SELECT 
                enchere.*,
                timbre.nom,timbre.pays_id,
                images.liens_images
            FROM $this->table
            JOIN timbre ON $this->table.timbre_id = timbre.id
            LEFT JOIN images ON timbre.id = images.timbre_id 
            AND images.image_principale = 1
            WHERE $this->table.date_fin < NOW()";

    if ($stmt = $this->query($sql)) {
        return $stmt->fetchAll();
    } else {
        return false;
    }
}
    public function selectActives() {
    $sql = "SELECT 
                enchere.*,
                timbre.nom,timbre.pays_id,
                images.liens_images
            FROM $this->table
            JOIN timbre ON $this->table.timbre_id = timbre.id
            LEFT JOIN images ON timbre.id = images.timbre_id 
            AND images.image_principale = 1
            WHERE $this->table.date_fin >= NOW()";

    if ($stmt = $this->query($sql)) {
        return $stmt->fetchAll();
    } else {
        return false;
    }
}

    
}



?>