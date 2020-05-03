<?php

use Controller\UserController;

$router = new Router\Router(new Router\Request);

function isGiven(Array $params, Array $object) {

    foreach ($params as $p) {
        if (!array_key_exists($p, $object)) {
            return false;
        }
    }

    return true;
}

/**
 * Route Index `/`
 * Method GET
 */
$router->get("/", function ( \Router\Request $request ) {

});

/**
 * Route Login `/login`
 * Method GET
 */
$router->get('/login', function () {
    $controller = new Controller\IndexController();

    $view = new View\LoginView($controller, null);

    return $view->render();
});

/**
 * Route Login `/login`
 * Method POST
 *
 * Body email-address=<email@adress>&password=<password>
 */
$router->post('/login', function ( \Router\Request $request ) {
    $params = $request->getBody();

    if (!isGiven(["email-address", "password"], $params)) {
        return;
    }

    $emailAddress = $params[ "email-address" ];

    $controller = new UserController(new \Model\User());
    $user = $controller->getUserByEmail($emailAddress);

    $password = $params[ "password" ];

    if ( $controller->validatePassword($password) === false ) {
        header("Location: /login");
        $_SESSION[ 'isAuthenticated' ] = false;
        return;
    }

    $_SESSION[ 'isAuthenticated' ] = true;
    $_SESSION[ "userId" ] = $user->getId();

    header("Location: /user?user_id=" . $user->getId());
});

/**
 * Route Logout
 * Method Post
 */
$router->get('/logout', function () {
    session_destroy();

    header("Refresh:0; url=/");
});

/**
 * Route User `/user?userId=xxx`
 * Method GET
 *
 */
$router->get('/user', function ( \Router\Request $request ) {
    $controller = new UserController(new Model\User());

    if ( ! isGiven(['userId'], $_SESSION) ) {
        return;
    }

    $id = $_SESSION[ "userId" ];

    $user = $controller->getUserById($id);

    $view = new View\UserView($controller, $user);

    return $view->render();
});

$router->get('/articles', function ( \Router\Request $request ) {
    $model = new Model\Article();
    $controller = new Controller\ArticleController();

    $view = new View\ArticleView($controller, $model);

    return $view->render();
});
