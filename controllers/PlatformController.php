<?php
namespace App\Controllers;

use App\Models\Game;
use App\Models\Platform;
use App\Providers\View;
use App\Models\GamePlatform;
use App\Providers\Auth;

class PlatformController {

    public function create($data = []){
        Auth::session();
        Auth::privilege(1);

        if(isset($data['id'])){
            $game = new Game;
            $game = $game->selectId($data['id']);

            if($game){
                $platforms = new Platform;
                $platforms = $platforms->select('name');

                return View::render('platform/create', ['game' => $game, 'platforms' => $platforms]);
            }else{
                return View::render('error', ['msg' => 'Game not found']);
            }
        }else{
            return View::render('error', ['msg' => 'Game not found']);
        }
    }

    /*Save a new platform version for a game */
    public function store(array $data){
        Auth::session();
        Auth::privilege(1);

        $gamePlatform = new GamePlatform;
        $gamePlatform->insert($data);

        return View::redirect('game/show?id='.$data['game_id']);
    }

  
    public function delete($data){
        Auth::session();
        Auth::privilege(1);

        $gamePlatform = new GamePlatform;

        /* SQL query because game_platform has a
        composite primary key (game_id, platform_id, copy_type). */
        $sql = "DELETE FROM game_platform
                WHERE game_id = :game_id
                AND platform_id = :platform_id
                AND copy_type = :copy_type";

        $stmt = $gamePlatform->prepare($sql);
        $stmt->bindValue(':game_id', $data['game_id']);
        $stmt->bindValue(':platform_id', $data['platform_id']);
        $stmt->bindValue(':copy_type', $data['copy_type']);
        $stmt->execute();

        return View::redirect('game/show?id='.$data['game_id']);
    }


}
