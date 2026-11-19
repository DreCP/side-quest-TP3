<?php
namespace App\Providers;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View {
    /*To load the Twig template and display it */
    static public function render(string $template, $data = []){
        $loader = new FilesystemLoader('views');
        $twig = new Environment($loader);
        $twig->addGlobal('asset', ASSET);
        $twig->addGlobal('base', BASE);
        $twig->addGlobal('session', $_SESSION);
        echo $twig->render($template.".php", $data);
    }

    /*To redirect the user to another page after an action */
    static public function redirect(string $url){
        header('location:'.BASE.'/'.$url);
    }
}
?>
