<?php
/**
 * Define the routes that handle the different user requests.
 */

use Controller\ArticleController;
use Controller\UserController;
use Model\Article;
use View\ArticleView;

$router = new Router\Router(new Router\Request());

/**
 * home
 *
 * Route `/`
 * Method GET
 */
$router->get("/", function (\Router\Request $request) {});

/**
 * Render the login formula
 *
 * Route Login `/login`
 * Method GET
 */
$router->get('/login', function () {
    $view = new View\LoginView(new \Model\QueryResult(null, null));
    return $view->render();
});

/**
 *
 * User login
 *
 * Route `/login`
 * Method POST
 *
 * Body email-address=<email@adress>&password=<password>
 */
$router->post('/login', function (\Router\Request $request) {
    $params = $request->getBody();

    if (!isGiven(["email-address", "password"], $params)) {
        return "";
    }

    $emailAddress = $params["email-address"];
    $password = $params["password"];

    $controller = new UserController(new \Model\User());
    $queryResult = $controller->getUserByEmail($emailAddress);

    $loginView = new \View\LoginView($queryResult);

    if ($queryResult->hasError()) {
        return $loginView->render();
    }

    if (
        $controller->validatePassword($password, $queryResult->getResult()) ===
        false
    ) {
        \Controller\SessionController::setAuthenticatedState(false);
        $loginView->validationError();

        return $loginView->render();
    }

    \Controller\SessionController::setAuthenticatedState(true);
    \Controller\SessionController::setAuthenticatedUserId(
        $queryResult->getResult()->getId()
    );

    header("Location: /user");
});

/**
 * User logout
 *
 * Route Logout
 * Method Post
 */
$router->get('/logout', function () {
    session_destroy();

    header("Refresh:0; url=/login");
});

/**
 * Get current session user information
 *
 * Route User `/user`
 * Method GET
 *
 */
$router->get('/user', function (\Router\Request $request) {
    $controller = new UserController(new Model\User());

    $id = \Controller\SessionController::getAuthenticatedUserId();

    if ($id === null) {
        return "";
    }

    $user = $controller->getUserById($id);

    $view = new View\UserView($user);

    return $view->render();
});

/**
 * update user information
 *
 * Route `/user
 * Method POST
 *
 */
$router->post('/user', function (\Router\Request $request): string {
    $controller = new UserController(new \Model\User());
    $id = \Controller\SessionController::getAuthenticatedUserId();

    if ($id === null) {
        return "";
    }

    $params = $request->getBody();

    if (
        !isGiven(["firstName", "lastName", "emailAddress", "password"], $params)
    ) {
        return "";
    }

    $user = $controller->updateUserById(
        $id,
        $params["firstName"],
        $params["lastName"],
        $params["emailAddress"],
        $params["password"]
    );

    $view = new View\UserView($user);

    return $view->render();
});

/**
 * Get all articles
 *
 * Route `/articles`
 * Method GET
 */
$router->get('/articles', function (\Router\Request $request): string {
    $controller = new Controller\ArticleController();
    $controller->setModel(new Model\Article());
    $result = $controller->getAllArticles();

    $view = new View\ArticleView($result);

    return $view->render();
});

/**
 * add an article to the shopping cart
 *
 * Route `/articles/add-to-cart?article_id=xxx`
 * Method GET
 */
$router->get("/articles/add-to-cart", function (\Router\Request $request) {
    $params = $request->getParams();

    if (!isGiven(["article_id"], $params)) {
        return "";
    }

    $article_id = $params["article_id"];
    $shoppingCartId = \Controller\SessionController::getShoppingCartId();

    $cartController = new Controller\ShoppingCartController();
    $cartController->setModel(new \Model\ShoppingCart());
    $cartController->addArticle($shoppingCartId, $article_id);

    $controller = new Controller\ArticleController();
    $controller->setModel(new Model\Article());
    $articles = $controller->getAllArticles();

    $view = new View\ArticleView($articles);

    return $view->render();
});

/**
 * get current valid shopping cart
 *
 * Route `/shopping-cart`
 * Method GET
 *
 */
$router->get('/shopping-cart', function (\Router\Request $request): string {
    $controller = new Controller\ShoppingCartController();
    $controller->setModel(new \Model\ShoppingCart());

    $shoppingCart = $controller->getById(
        \Controller\SessionController::getShoppingCartId()
    );

    $view = new View\ShoppingCartView($shoppingCart);
    return $view->render();
});

/**
 * test if all params are part of the given object
 *
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
