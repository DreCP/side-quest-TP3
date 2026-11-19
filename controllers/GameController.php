<?php
namespace App\Controllers;

use App\Models\Game;
use App\Providers\View;
use App\Models\Developer;
use App\Models\Genre;
use App\Models\Platform;
use App\Models\GamePlatform;
use App\Providers\Validator;
use App\Providers\Auth;

class GameController{

    /*Display the game's details (developer, genre and platform) */
  public function show($data = []){
      if(isset($data['id'])){
          $id = $data['id'];
          $crud = new Game;
          $game = $crud->selectId($id);
          if($game){
            $developerId = $game['developer_id'];
            $developer = new Developer;
            $developer = $developer->selectId($developerId);
            $developerName = $developer['name'];

            $genreId = $game['genre_id'];
            $genre = new Genre;
            $genre = $genre->selectId($genreId);
            $genreName = $genre['name'];
            
            $gamePlatforms = new GamePlatform;
            $gamePlatforms = $gamePlatforms->select('game_id');

            $platforms = new Platform;
            $platforms = $platforms->select('name');

            return View::render('game/show', ['game' => $game, 'developerName' => $developerName, 'genreName' => $genreName, 'gamePlatforms' => $gamePlatforms, 'platforms' => $platforms]);


          }else{
            return View::render('error', ['msg'=>'Game not found']);
          }
        }else{
            return View::render('error', ['msg'=>'Code 404 - Page not found']);
        }
    }

    /*Load the options on the form for Add Game */
    public function create(){
        Auth::session();
        Auth::privilege(1);

        $developers = new Developer;
        $developers = $developers->select('name');

        $genres = new Genre;
        $genres = $genres->select('name');

        $platforms = new Platform;
        $platforms = $platforms->select('name');

        return View::render('game/create', ['developers' => $developers, 'genres' => $genres, 'platforms' => $platforms]);
    }

    /*Validate the form, upload the image and save the game */
    public function store(array $data){
        Auth::session();
        Auth::privilege(1);

        $val = new Validator;

        $val->field('title', $data['title'])->required()->min(3)->max(255);
        $val->field('release_date', $data['release_date'])->required();
        $val->field('description', $data['description'])->required();
        $val->field('max_local_players', $data['max_local_players'])->required()->int();
        $val->field('developer_id', $data['developer_id'], 'Developer')->required()->int();
        $val->field('genre_id', $data['genre_id'], 'Genre')->required()->int();
        $val->field('platform_id', $data['platform_id'], 'Platform')->required()->int();
        $val->field('copy_type', $data['copy_type'], 'Copy Type')->required();
        $val->field('price', $data['price'])->required();

        

        if($val->isSuccess()){

            /*Check the uploaded image and saves it*/
            
            if(!isset($_FILES['image']) || $_FILES['image']['error'] != 0){
                echo "Image upload failed";
                return;
            }

            $imageName = basename($_FILES['image']['name']);
            $imageTemp = $_FILES['image']['tmp_name'];

            $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            $extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

            if(!in_array($extension, $allowedExtensions) || !getimagesize($imageTemp)){
                echo "Invalid image";
                return;
            }

            $imageName = uniqid() . '.' . $extension;

            if(!move_uploaded_file($imageTemp, 'public/images/' . $imageName)){
                echo "Image upload failed";
                return;
            }

            $data['image'] = $imageName;
            /*Fin */

            $game = new Game;
            $insert = $game->insert($data);


            if($insert){
                $gamePlatform = new GamePlatform;

                /*Link the game to its platform, copy type and price. */
                $platformData = [
                    'game_id' => $insert,
                    'platform_id' => $data['platform_id'],
                    'copy_type' => $data['copy_type'],
                    'price' => $data['price']
                ];


                $gamePlatform->insert($platformData);

                return View::redirect('game/show?id='.$insert);

            }else{
                return View::render('error', ['msg' => 'Unable to create game']);
            }

        /*If the user submit wrong info while trying to add a game, it reloads the form */
        }else{
            $errors = $val->getErrors();

            $developers = new Developer;
            $developers = $developers->select('name');

            $genres = new Genre;
            $genres = $genres->select('name');

            $platforms = new Platform;
            $platforms = $platforms->select('name');

            return View::render('game/create', [
                'errors' => $errors,
                'game' => $data,
                'developers' => $developers,
                'genres' => $genres,
                'platforms' => $platforms
            ]);



        }


    }

    
    public function edit($data = []){
        Auth::session();
        Auth::privilege(1);

        if(isset($data['id'])){
            $id = $data['id'];
            $game = new Game;
            $game = $game->selectId($id);

            if($game){
                $developers = new Developer;
                $developers = $developers->select('name');

                $genres = new Genre;
                $genres = $genres->select('name');

                return View::render('game/edit', ['game' => $game, 'developers' => $developers, 'genres' => $genres]);
            }else{
                return View::render('error', ['msg' => 'Game not found']);
            }
        }else{
            return View::render('error', ['msg' => 'Game not found']);
        }
    }

    
    public function update(array $data, $get = []){
        Auth::session();
        Auth::privilege(1);

        if($get['id']){
            $val = new Validator;

            $val->field('title', $data['title'])->required()->min(3)->max(255);
            $val->field('release_date', $data['release_date'])->required();
            $val->field('description', $data['description'])->required();
            $val->field('max_local_players', $data['max_local_players'])->required()->int();
            $val->field('developer_id', $data['developer_id'], 'Developer')->required()->int();
            $val->field('genre_id', $data['genre_id'], 'Genre')->required()->int();

            if($val->isSuccess()){
                $game = new Game;
                $game = $game->update($data, $get['id']);

                if($game){
                    return View::redirect('game/show?id='.$get['id']);
                }else{
                    return View::render('error', ['msg' => 'Unable to update game']);
                }
            }else{
                $errors = $val->getErrors();

                $developers = new Developer;
                $developers = $developers->select('name');

                $genres = new Genre;
                $genres = $genres->select('name');

                $data['id'] = $get['id'];

                return View::render('game/edit', ['errors' => $errors, 'game' => $data, 'developers' => $developers, 'genres' => $genres]);
            }
        }else{
            return View::render('error', ['msg' => 'Unable to update game']);
        }
    }


    public function delete($data){
        Auth::session();
        Auth::privilege(1);

        $gamePlatform = new GamePlatform;

        /*Delete the game platforms first so we can delete the game without errors. */
        $sql = "DELETE FROM game_platform WHERE game_id = :game_id";
        $stmt = $gamePlatform->prepare($sql);
        $stmt->bindValue(':game_id', $data['id']);
        $stmt->execute();

        $game = new Game;
        $delete = $game->delete($data['id']);

        if($delete){
            return View::redirect('');
        }else{
            return View::render('error', ['msg' => 'Unable to delete game']);
        }
    }


}
