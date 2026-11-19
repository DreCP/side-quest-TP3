<?php
namespace App\Models;
use App\Models\CRUD;

class Developer extends CRUD{
    protected $table = 'developer';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'country'];
}

?>
