<?php
namespace App\Controllers;

use App\Models\Wishlist;
use App\Providers\Auth;

class WishlistController {

    /*method to add a game to wishlist */
    public function store(array $data){

        Auth::session();            /*check if the user is logged in */
        Auth::privilege(2);         /*only clients are able to add to wishlist */

        $wishlist = new Wishlist;   /*save the games in database*/

        $data['user_id'] = $_SESSION['user_id'];

        $result = $wishlist->insert($data);

        if($result){
            echo json_encode(['success' => true, 'id' => $result]); /*sends response to JS instead of redirecting the browser */
        }else{
            echo json_encode(['success' => false]);
        }
    }

    /*method to remove games from wishlist */
    public function delete(array $data){

        Auth::session();
        Auth::privilege(2);

        $wishlist = new Wishlist;

        $items = $wishlist->select();       /*retrieves wishlist record */

        foreach($items as $item){   /*find the record matching the requested wishlist ID */

            /*check if the wishlist belongs to the logged-in user */
            if($item['id'] == $data['id'] && $item['user_id'] == $_SESSION['user_id']){

                $wishlist->delete($item['id']);

                echo json_encode(['success' => true]);
                return;
            }
        }

        echo json_encode(['success' => false]);
    }

}
