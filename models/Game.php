<?php
namespace App\Models;
use App\Models\CRUD;

/*Model for the game table. Define its primary key and allowed fields */
class Game extends CRUD{
    protected $table = 'game';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'release_date', 'description', 'max_local_players', 'developer_id', 'genre_id', 'image'];
}

?>
