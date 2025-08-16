<?php
namespace App\Models;

use App\Models\CRUD;

class Images extends CRUD{
    protected $table = 'images';
    protected $primaryKey = 'id';
    protected $fillable = ['image_principale', 'timbre_id'];
}

?>