<?php
/**
 * This is the router for handling the order
 */

/**
 *
 * Route /order?id=<order-id>
 * Method GET
 */
$router->get("/order", function (\Router\Request $request) {
    $controller = new \Controller\OrderController(new \Model\Order());

    $orderId = $request->getParam("id");

    $controller->getOrderById($orderId);

    $view = new \View\OrderView(new \Model\QueryResult(null, null));

    return $view->render();
});

$router->post("/order", function (\Router\Request $request) {
    $controller = new \Controller\OrderController(new \Model\Order());
    $orderHash = $request->getParam("order_hash");
    $token = $request->getParam("token");

    $userId = \Controller\SessionController::getAuthenticatedUserId();
    $total = $request->getParam("total");

    if (
        md5(
            $userId . $total . \Controller\SessionController::getOrderToken()
        ) !== $orderHash
    ) {
        return "the order is unvalid. Please try again";
    }

    if (!\Controller\SessionController::isCSRFTokenValid($token)) {
        return "invalid token";
    }

    $result = $controller->createOrder(
        $total,
        $userId,
        \Controller\SessionController::getShoppingCartId()
    );

    if ($result->hasError()) {
        die("Internal server error");
    }

    \Controller\SessionController::createShoppingCart();
    if (is_null($result->getResult())) {
        die("no order");
    }
    header('Location: /order?id=' . $result->getResult()->getId());
});
