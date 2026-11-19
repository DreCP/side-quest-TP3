<?php
namespace App\Models;

use App\Models\CRUD;

class Wishlist extends CRUD {

    protected $table = 'wishlist';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'game_id'];

}
