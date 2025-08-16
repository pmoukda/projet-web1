<?php
namespace App\Providers;

class Validator{
    private $errors = array();
    private $key;
    private $value;
    private $name;


    public function field($key, $value, $name = null){
        $this->key = $key;
        $this->value = $value;
        if($name == null){
            $this->name = ucfirst($key);
        }else{
            $this->name = ucfirst($name);
        }
        return $this;
    }
    
    public function required(){
        if(empty($this->value)){
            $this->errors[$this->key] = "$this->name est requis.";
        }
        return $this;
    }
    public function min($lenght){
        if(mb_strlen($this->value) < $lenght){
            $this->errors[$this->key] = "$this->name doit contenir au minimum $lenght caractères.";
        }
        return $this;
    }
    public function max($lenght){
           if(mb_strlen($this->value) > $lenght){
            $this->errors[$this->key] = "$this->name doit contenir au maximum $lenght caractères.";
        }
        return $this;
    }
    public function number(){
        if (!empty($this->value) && !is_numeric($this->value)) {
            $this->errors[$this->key] = "$this->name doit être un nombre.";
        }
        return $this;
    }
    public function email(){
        if (!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$this->key]="$this->name est invalide.";
        }
        return $this;
    }
    public function unique($model){
        $model = 'App\\Models\\' . $model;
        $model = new $model;
        $unique = $model->unique($this->key, $this->value);
        if($unique){
            $this->errors[$this->key] = "$this->name doit être unique.";
        }
        return $this;

    }
    public function validateDate($format = 'Y-m-d'){
        $date = \DateTime::createFromFormat($format, $this->value);
        if(!$date || $date->format($format) !== $this->value){
            $this->errors [$this->key] = "Le format de $this->name est invalide. Veuillez utilisaer ce $format.";
        }
        return $this;
    }
    public function validateYear(){
        if(!preg_match('/^\d{4}$/', $this->value) || $this->value < 1800 || $this->value > date('Y') + 10){
            $this->errors[$this->key] = "L'année doit être un nombre entre 1800 et " . (date('Y') + 10);
        }
        return $this;
    }
  public function int(){
        if(!filter_var($this->value, FILTER_VALIDATE_INT)){
            $this->errors[$this->key]="$this->name doit être un nombre entier.";
        } 
        return $this;
    }
public function yesNo() {
    if (!in_array($this->value, [0, 1, '0', '1'], true)) {
        $this->errors[$this->key] = "$this->name doit être Oui ou Non.";
    }
    return $this;
}

    public function float(){
        if(!filter_var($this->value, FILTER_VALIDATE_FLOAT)){
            $this->errors[$this->key]="$this->name doit être un nombre décimal.";
        } 
        return $this;
    }
        public function bigger($limit) {
        if ($this->value >= $limit) {
            $this->errors[$this->key]="$this->name doit être inférieur ou égal à $limit.";
        }
        return $this;
    }

    public function lower($limit) {
        if ($this->value <= $limit) {
            $this->errors[$this->key]="$this->name doit être supérieur ou égal à $limit.";
        }
        return $this;
    }
  
    public function isSuccess(){
        if(empty($this->errors)) return true;
    }

   public function getErrors(){
        if(!$this->isSuccess()) return $this->errors;
    }

}

