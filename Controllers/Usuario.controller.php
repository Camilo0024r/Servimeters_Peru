<?php
require_once 'Base.controller.php';

if (isset($_GET['path'])) {
    $path = $_GET['path'];
    require_once $path . 'config.php';
} else {
    require_once 'config.php';
}
require_once FOLDERSIDE . 'Models/Usuario.model.php';

class UsuarioController extends BaseController
{
    private static $result;

    /**
     * @return array
     */
    public static function index()
    {
        parent::setModel(new UsuarioModel());
        return parent::getAll();
    }

    /**
     * @return string
     */
    static public function saveUser()
    {
        if (isset($_GET['action']) && strcmp($_GET['action'], 'insert') == 0) {
            parent::setModel(new UsuarioModel($_POST));
            parent::insert();
        }
    }

    static public function updateUser()
    {
        session_start();
        self::$result = new stdClass();
        $user = array_merge($_POST);
        $user['password'] = $_SESSION['password'];

        parent::setModel(new UsuarioModel($user));
        $result = parent::update();
        self::$result->Result = $result["status"];

        if (!empty(self::$result->Result)) {
            $_SESSION["estado"] = $_POST["estado"];
        }
        header('Content-Type: application/json');
        echo json_encode(self::$result);
    }
}

if (isset($_GET['method'])) {
    $method = $_GET['method'];
    UsuarioController::$method();
    exit();
}
