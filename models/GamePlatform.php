<?php
namespace App\Models;
use App\Models\CRUD;

/*Model for the game_platform table, linking games to platforms, copy types and prices */
class GamePlatform extends CRUD{
    protected $table = 'game_platform';
    protected $primaryKey = 'game_id';
    protected $fillable = ['game_id', 'platform_id', 'copy_type', 'price'];
}

?>
