<?php

require_once( 'autoload.php' );
require_once( 'Public/Templates/Main.inc' );

use Configuration\Configuration;
use Database\Database;

$configuration = Configuration::instance();
$database = Database::instance();

$router = new Router\Router(new Router\Request);

$router->get("/", function ( \Router\Request $request ) {
    header("Location: /login");
});

/* index route*/
$router->get('/login', function () {
    $model = new Model\Login();
    $controller = new Controller\IndexController();

    $view = new View\IndexView($controller, $model);
    session_start();

    return $view->render();
});

$router->get('/user', function ( \Router\Request $request ) {
    foreach ( $request->getParams() as $key => $value ) {
        echo $key . " = " . $value . "<br>";
    }

    $model = new Model\User();
    $controller = new \Controller\UserController();

    $view = new View\UserView($controller, $model);
    $view->setProperties(array( "name" => "Lukas" ));
    return $view->render();
});

