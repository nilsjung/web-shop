<?php

namespace Controller;

use Model\QueryResult;

/**
 * Class ArticleController
 *
 * @package Controller
 */
class PaymentController extends Controller
{
    public function getPayment(
        ?string $userId,
        ?string $shoppingCartId
    ): QueryResult {
        if (is_null($shoppingCartId) || is_null($userId)) {
            die("should not be null");
        }

        $secret = SessionController::generateOrderToken();

        $result = $this->model->getPaymentForUserAndShoppingCart(
            $userId,
            $shoppingCartId
        );

        $result->getResult()->generatePaymentHash($secret);

        return $result;
    }
}
