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
