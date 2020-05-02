<?php

use Model\Login;

$router = new Router\Router(new Router\Request);

$router->get("/", function ( \Router\Request $request ) {});

/* index route*/
$router->get('/login', function () {
    $controller = new Controller\IndexController();

    $_SESSION[ "isAuthenticated" ] = true;

    header("Refresh:0; url=/user");

    $view = new View\IndexView($controller, null);

    return $view->render();
});

/* index route*/
$router->get('/logout', function () {
    session_destroy();

    header("Refresh:0; url=/");
});

$router->get('/user', function ( \Router\Request $request ) {
    $model = new Model\User();
    $controller = new Controller\UserController();

    $view = new View\UserView($controller, $model);

    return $view->render();
});

$router->get('/articles', function ( \Router\Request $request ) {
    $model = new Model\Article();
    $controller = new Controller\ArticleController();

    $view = new View\ArticleView($controller, $model);

    return $view->render();
});
