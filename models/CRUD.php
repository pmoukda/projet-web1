<?php
namespace App\Models;

Abstract class CRUD extends \PDO{
    public function __construct(){
        parent::__construct('mysql:host=localhost;dbname=stampee;port=3306;charset=utf8' ,username:'root', password: '');
    }

    // Fonction select
    final public function select($field = null, $order = 'asc'){
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

    // Fonction select by id
    final public function selectId($value){
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);
        $stmt-> execute();
        $count = $stmt->rowCount();

        if($count == 1){
            return $stmt->fetch();
        }else{
            return false;
        }
    }
    
   // Fonction insérer les données
    final public function insert($data){

        $data_keys = array_fill_keys($this->fillable, '');
        $data = array_intersect_key($data, $data_keys);
 
        $fieldName = implode(', ', array_keys($data));
        $fieldValue = ":".implode(', :', array_keys($data));
        $sql = "INSERT INTO $this->table ($fieldName) VALUES ($fieldValue);";

        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        if($stmt->execute()){
            return $this->lastInsertId();
        }else{
            return false;
        } 
    }

    // Fonction update
      final public function update($data, $id){
        $data_keys = array_fill_keys($this->fillable, '');
        $data = array_intersect_key($data, $data_keys);
        
        $fieldName = null;
        foreach($data as $key=>$value){
            $fieldName .= "$key = :$key, ";
        }
        $fieldName = rtrim($fieldName, ', ');
        $sql = "UPDATE $this->table SET $fieldName WHERE $this->primaryKey = :$this->primaryKey";
        // return $sql;
        $data[$this->primaryKey] = $id;
        
        //    print_r($data);
        //    die();
        $stmt = $this->prepare($sql);
        foreach($data as $key=>$value){
            $stmt->bindValue(":$key", $value);
        }
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    // Fonction delete
      final public function delete($value){
        
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }  
    }
    
    // Fonction de donnée unique
     public function unique($field, $value){
        $sql = "SELECT * FROM $this->table WHERE $field = :$field";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$field", $value);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 1){
            return $stmt->fetch();
        }else{
            return false;
        }

    }

    
}


?>