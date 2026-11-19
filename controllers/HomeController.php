<?php
namespace App\Controllers;

use App\Models\Game;
use App\Providers\View;
use App\Models\Wishlist;

class HomeController {

    public function index(){

        $game = new Game;
        $games = $game->select();

        $wishlists = [];

        if(isset($_SESSION['user_id']) && $_SESSION['user_privilege'] == 2){
            $wishlist = new Wishlist;
            $wishlists = $wishlist->select();
        }

        return View::render('home', [
            'games' => $games,
            'wishlists' => $wishlists
        ]);
    }
}

?>
