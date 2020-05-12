<?php
/**
 * Define the routes that handle the different user requests.
 */

use Controller\UserController;

$router = new Router\Router(new Router\Request());

/**
 * @param array $params
 * @param array $object
 * @return bool
 */
function isGiven(array $params, array $object)
{
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
$router->get("/", function (\Router\Request $request) {});

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
$router->post('/login', function (\Router\Request $request) {
    $params = $request->getBody();

    if (!isGiven(["email-address", "password"], $params)) {
        return;
    }

    $emailAddress = $params["email-address"];
    $password = $params["password"];

    $controller = new UserController(new \Model\Domain\User());
    $user = $controller->getUserByEmail($emailAddress);

    $loginView = new \View\LoginView($controller, null);
    if (is_null($user)) {
        $loginView->validationError();
        return $loginView->render();
    }

    if ($controller->validatePassword($password) === false) {
        \Controller\SessionController::setAuthenticatedState(false);
        $loginView->validationError();

        return $loginView->render();
    }

    \Controller\SessionController::setAuthenticatedState(true);
    \Controller\SessionController::setAuthenticatedUserId($user->getId());

    header("Location: /user");
});

/**
 * Route Logout
 * Method Post
 */
$router->get('/logout', function () {
    session_destroy();

    header("Refresh:0; url=/login");
});

/**
 * Route User `/user?userId=xxx`
 * Method GET
 *
 */
$router->get('/user', function (\Router\Request $request) {
    $controller = new UserController(new Model\Domain\User());

    $id = \Controller\SessionController::getAuthenticatedUserId();

    if ($id === null) {
        return;
    }

    $user = $controller->getUserById($id);

    $view = new View\UserView($controller, $user);

    return $view->render();
});

$router->post('/user', function (\Router\Request $request) {
    $controller = new UserController(new \Model\Domain\User());
    $id = \Controller\SessionController::getAuthenticatedUserId();

    if ($id === null) {
        return;
    }

    $params = $request->getBody();

    if (
        !isGiven(["firstName", "lastName", "emailAddress", "password"], $params)
    ) {
        return;
    }

    $user = $controller->updateUserById(
        $id,
        $params["firstName"],
        $params["lastName"],
        $params["emailAddress"],
        $params["password"]
    );

    $view = new View\UserView($controller, $user);

    return $view->render();
});

$router->get('/articles', function (\Router\Request $request) {
    $model = new Model\Article();
    $controller = new Controller\ArticleController();

    $view = new View\ArticleView($controller, $model);

    return $view->render();
});
