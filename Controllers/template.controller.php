<?php
require_once FOLDERSIDE . "Models/DB.php";

/**
 * @author Ricardo Enciso Bautista - Esteban Serna Palacios 😉😜
 */

class ControladorTemplate extends DB
{
    const PATH_VIEWS = "/Peru/Views/pages/";
    /**
     * @param String $router - mucho texto
     */
    static function router(String $router = "default")
    {
        $db = new DB();
        /*valor en true crea la basededatos con la configuracion enviada en la clase DB*/
        // $con = $db->connect(true);
        $con = $db->connect();

        echo DB::getError($db) . "\t\n";
        echo DB::getError($con) . "\t\n";

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
