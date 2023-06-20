<?php

// require_once FOLDERSIDE . "/Models/DB.php";

/**
 * @author Ricardo Enciso Bautista
 * @author Esteban Serna Palacios 😉😜
 */

class ControladorTemplate
{

    const PATH_VIEWS = "/peru/Views/pages/";

    /**
     * @param String $router - mucho texto
     */
    static function router(String $router = "default")
    {
        // $db = new DB();
        // $con = $db->connect(); --Lo deshabilite, Perdon :(
        $router = $router . (strpos($router, ".php") === false ? ".php" : "");
        $routerFile = $_SERVER['DOCUMENT_ROOT'] . SELF::PATH_VIEWS . $router;
        $router404 = str_replace($router, "Error/404.php", $routerFile);
        if (file_exists($routerFile)) {
            include($routerFile);
        } else {
            include($router404);
        }
    }
}
