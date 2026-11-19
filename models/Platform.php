<?php
namespace App\Models;
use App\Models\CRUD;

class Platform extends CRUD{
    protected $table = 'platform';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
}

?>
