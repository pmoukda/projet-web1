<?php
namespace App\Models;

use App\Models\CRUD;

class Images extends CRUD {
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = ['image_principale', 'timbre_id', 'liens_images'];


       final public function selectbyTimbreId($field = 'timbre_id', $order = 'desc'){
        if($field == null){
            $field = $this->primaryKey;
        }
        $sql = "SELECT * FROM $this->table ORDER BY $field $order";
        // return $sql;
        if($stmt = $this->query($sql)){
            return $stmt->fetchAll();
        }else{
            return false;
        }
    }
}
?>