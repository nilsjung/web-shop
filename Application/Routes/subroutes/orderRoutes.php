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
    $orderId = $request->getParam("id");
    $view = new \View\OrderView(new \Model\QueryResult(null, null));

    return $view->render();
});

$router->post("/order", function (\Router\Request $request) {
    $orderHash = $request->getParam("order_hash");
    $token = $request->getParam("token");
    $shoppingCartId = \Controller\SessionController::getShoppingCartId();
    $userId = \Controller\SessionController::getAuthenticatedUserId();
    $total = $request->getParam("total");

    if (
        md5(
            $userId . $total . \Controller\SessionController::getOrderToken()
        ) !== $orderHash
    ) {
        die("the order is unvalid. Please try again");
    }

    header('Location: /order');
});
