<?php
/**
 * checkout process
 */

use Model\QueryResult;
use Model\ShoppingCart;
use Model\User;
use View\Partials\PaymentLoginPartialView;

/**
 * Route `/payment`
 * This route handles the view logic and delegates the work to the other routes.
 * They always redirect to this route after completing
 *
 * Method GET
 *
 */
$router->get('/payment', function (\Router\Request $request): string {
    $paymentController = new Controller\PaymentController(new \Model\Payment());

    $view = new View\PaymentView(new QueryResult(null, null));

    $step = $request->getParam("step");
    $token = $request->getParam("token");

    if (!\Controller\SessionController::isCSRFTokenValid($token)) {
        die("Not Valid");
    }

    if (is_null(\Controller\SessionController::getAuthenticatedUserId())) {
        // no user logged in
        $view->setProperties([
            "loginPartial" => (new PaymentLoginPartialView(
                new QueryResult(null, null)
            ))->render(),
            "paymentPartial" => "",
            "userPartial" => "",
        ]);
    } else {
        // get logged in user information
        $paymentQueryResult = $paymentController->getPayment(
            \Controller\SessionController::getAuthenticatedUserId(),
            \Controller\SessionController::getShoppingCartId()
        );

        $view->setProperties([
            "loginPartial" => (new PaymentLoginPartialView(
                new QueryResult(null, null)
            ))->render(),
            "paymentPartial" => (new \View\Partials\PaymentPaymentPartialView(
                $paymentQueryResult
            ))->render(),
            "userPartial" => (new \View\Partials\PaymentUserPartialView(
                $paymentQueryResult
            ))->render(),
        ]);
    }

    if (!is_null($step)) {
        $view->setProperties(["paymentStep" => (int) $step]);
    }

    return $view->render();
});

$router->post("/payment/login", function (\Router\Request $request) {
    $emailAddress = $request->getParam("email_address");
    $password = $request->getParam("password");

    if (!($emailAddress && $password)) {
        return "missing parameter";
    }

    \Controller\SessionController::resetSessionToken();

    $controller = new \Controller\UserController(new User());
    $queryResult = $controller->login($emailAddress, $password);

    $loginView = new \View\LoginView($queryResult);

    if ($queryResult->hasError()) {
        return $loginView->render();
    }

    \Controller\SessionController::setAuthenticatedState(true);
    \Controller\SessionController::setAuthenticatedUserId(
        $queryResult->getResult()->getId()
    );

    header(
        "Location: /payment?step=1&token=" .
            \Controller\SessionController::getCSRFToken()
    );
});

$router->post("/payment/user/update", function (\Router\Request $request) {
    header(
        "Location: /payment?step=2&token=" .
            \Controller\SessionController::getCSRFToken()
    );
});

/**
 * increase given item in shopping cart
 */
$router->get("/payment/shopping-cart/add/", function (
    \Router\Request $request
) {
    $articleId = $request->getParam("article_id");
    $request->checkToken();

    if (!$articleId) {
        return "article id not given";
    }

    $shoppingCartId = \Controller\SessionController::getShoppingCartId();

    if (!\Model\Domain\GUID::validate($articleId)) {
        return "not a valid id";
    }

    $controller = new \Controller\ShoppingCartController(
        new \Model\ShoppingCart()
    );

    $shoppingCart = $controller->addArticle($shoppingCartId, $articleId);
    $view = new \View\ShoppingCartView($shoppingCart);
    header(
        "Location: /payment?step=2&token=" .
            \Controller\SessionController::getCSRFToken()
    );

    return $view->render();
});

/**
 * delete given article from current shopping cart
 *
 * Route `/shopping-cart/remove/?article_id=:id`
 * Method GET
 */
$router->get('/payment/shopping-cart/delete/', function (
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

    $controller = new \Controller\ShoppingCartController(
        new \Model\ShoppingCart()
    );

    $shoppingCart = $controller->deleteArticle($shoppingCartId, $articleId);

    $view = new View\ShoppingCartView($shoppingCart);
    header(
        "Location: /payment?step=2&token=" .
            \Controller\SessionController::getCSRFToken()
    );

    return $view->render();
});

/**
 * remove a given article from current shopping cart (decrement shopping cart count for item)
 *
 * Route `/shopping-cart/remove/?article_id=:id`
 * Method GET
 */
$router->get('/payment/shopping-cart/remove/', function (
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

    $controller = new \Controller\ShoppingCartController(
        new \Model\ShoppingCart()
    );

    $shoppingCart = $controller->removeArticle($shoppingCartId, $articleId);

    $view = new View\ShoppingCartView($shoppingCart);
    header(
        "Location: /payment?step=2&token=" .
            \Controller\SessionController::getCSRFToken()
    );

    return $view->render();
});
