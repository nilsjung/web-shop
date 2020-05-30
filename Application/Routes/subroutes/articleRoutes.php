<?php

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
    $articleId = $request->getParam("article_id");
    $request->checkToken();

    if (!$articleId) {
        return "";
    }

    $shoppingCartId = \Controller\SessionController::getShoppingCartId();

    $cartController = new Controller\ShoppingCartController();
    $cartController->setModel(new \Model\ShoppingCart());
    $cartController->addArticle($shoppingCartId, $articleId);

    $controller = new Controller\ArticleController();
    $controller->setModel(new Model\Article());
    $articles = $controller->getAllArticles();

    $view = new View\ArticleView($articles);
    header("Location: /articles");

    return $view->render();
});
