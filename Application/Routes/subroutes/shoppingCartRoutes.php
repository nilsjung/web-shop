<?php

/**
 * get current valid shopping cart
 *
 * Route `/shopping-cart`
 * Method GET
 *
 */

use Controller\UserController;

$router->get('/shopping-cart', function (): string {
    $controller = new Controller\ShoppingCartController();
    $controller->setModel(new \Model\ShoppingCart());

    $shoppingCart = $controller->getById(
        \Controller\SessionController::getShoppingCartId()
    );

    $view = new View\ShoppingCartView($shoppingCart);
    $view->setProperties(["paginationStep" => 0]);
    return $view->render();
});

$router->post('/shopping-cart/login', function (
    \Router\Request $request
): string {
    $emailAddress = $request->getParam("email");
    $password = $request->getParam("password");

    ob_clean();
    header('Content-Type: text/json');

    if (!($emailAddress && $password)) {
        return json_encode([
            "error" => "Password or email address is missing",
            "data" => null,
        ]);
    }

    \Controller\SessionController::resetSessionToken();
    $user = new \Model\User();
    $controller = new UserController($user);
    $queryResult = $controller->login($emailAddress, $password);

    if ($queryResult->hasError()) {
        return json_encode(["error" => "Email Address or Password wrong"]);
    }

    \Controller\SessionController::setAuthenticatedState(true);
    \Controller\SessionController::setAuthenticatedUserId(
        $queryResult->getResult()->getId()
    );

    return json_encode([
        "result" => [
            "error" => null,
            "token" => \Controller\SessionController::getCSRFToken(),
            "data" => [
                "firstName" => $queryResult->getResult()->getFirstName(),
                "lastName" => $queryResult->getResult()->getLastName(),
                "paymentMethod" => $queryResult
                    ->getResult()
                    ->getPaymentMethod(),
                "emailAddress" => $queryResult->getResult()->getEmailAddress(),
            ],
        ],
    ]);
});

$router->get('/shopping-cart/user/', function () {
    ob_clean();
    header('Content-Type: text/json');

    $controller = new UserController(new Model\User());
    $id = \Controller\SessionController::getAuthenticatedUserId();

    if ($id === null) {
        return "";
    }

    $queryResult = $controller->getUserById($id);

    return json_encode([
        "result" => [
            "error" => null,
            "token" => \Controller\SessionController::getCSRFToken(),
            "data" => [
                "firstName" => $queryResult->getResult()->getFirstName(),
                "lastName" => $queryResult->getResult()->getLastName(),
                "paymentMethod" => $queryResult
                    ->getResult()
                    ->getPaymentMethod(),
                "emailAddress" => $queryResult->getResult()->getEmailAddress(),
            ],
        ],
    ]);
});

/**
 * increase given item in shopping cart
 */
$router->get("/shopping-cart/add/", function (\Router\Request $request) {
    $articleId = $request->getParam("article_id");
    $request->checkToken();

    if (!$articleId) {
        return "article id not given";
    }

    $shoppingCartId = \Controller\SessionController::getShoppingCartId();

    if (!\Model\Domain\GUID::validate($articleId)) {
        return "not a valid id";
    }

    $controller = new \Controller\ShoppingCartController();
    $controller->setModel(new \Model\ShoppingCart());

    $shoppingCart = $controller->addArticle($shoppingCartId, $articleId);
    $view = new \View\ShoppingCartView($shoppingCart);
    header("Location: /shopping-cart");

    return $view->render();
});

/**
 * delete given article from current shopping cart
 *
 * Route `/shopping-cart/remove/?article_id=:id`
 * Method GET
 */
$router->get('/shopping-cart/delete/', function (
    \Router\Request $request
): string {
    $articleId = $request->getParam("article_id");
    $request->checkToken();

    if (!$articleId) {
        return "article id not given";
    }

    $shoppingCartId = \Controller\SessionController::getShoppingCartId();

    if (\Model\Domain\GUID::validate($articleId) === false) {
        return "no valid id";
    }

    $controller = new \Controller\ShoppingCartController();
    $controller->setModel(new \Model\ShoppingCart());

    $shoppingCart = $controller->deleteArticle($shoppingCartId, $articleId);

    $view = new View\ShoppingCartView($shoppingCart);
    header("Location: /shopping-cart");

    return $view->render();
});

/**
 * remove a given article from current shopping cart (decrement shopping cart count for item)
 *
 * Route `/shopping-cart/remove/?article_id=:id`
 * Method GET
 */
$router->get('/shopping-cart/remove/', function (
    \Router\Request $request
): string {
    $articleId = $request->getParam("article_id");

    $request->checkToken();
    if (!$articleId) {
        return "article id not given";
    }

    $shoppingCartId = \Controller\SessionController::getShoppingCartId();

    if (\Model\Domain\GUID::validate($articleId) === false) {
        return "no valid id";
    }

    $controller = new \Controller\ShoppingCartController();
    $controller->setModel(new \Model\ShoppingCart());

    $shoppingCart = $controller->removeArticle($shoppingCartId, $articleId);

    $view = new View\ShoppingCartView($shoppingCart);
    header("Location: /shopping-cart");

    return $view->render();
});
