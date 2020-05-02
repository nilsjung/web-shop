<?php

use Controller\IndexController;
use Model\Login;
use View\IndexView;

$router = new Router\Router(new Router\Request);

$router->get("/", function ( \Router\Request $request ) {
    header("Location: /login");
});

/* index route*/
$router->get('/login', function () {
    $model = new Model\Login();
    $controller = new Controller\IndexController();

    $_SESSION[ "isAuthenticated" ] = true;

    $view = new View\IndexView($controller, $model);

    return $view->render();
});

/* index route*/
$router->get('/logout', function () {
    session_destroy();

    $view = new View\IndexView(null, null);
    header("Refresh:0; url=/");
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