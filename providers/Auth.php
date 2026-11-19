<?php
namespace App\Providers;

use App\Providers\View;

class Auth {

    static public function session(){
        if(!isset($_SESSION['user_id'])){
            View::redirect('login');
            exit;
        }

        $fingerPrint = md5(
            $_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR']
        );

        if(
            !isset($_SESSION['fingerPrint']) ||
            $_SESSION['fingerPrint'] !== $fingerPrint
        ){
            session_destroy();
            View::redirect('login');
            exit;
        }
    }

    static public function privilege($privilege){
        if(
            !isset($_SESSION['user_privilege']) ||
            $_SESSION['user_privilege'] != $privilege
        ){
            View::redirect('');
            exit;
        }
    }
}
