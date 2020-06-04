<?php

namespace Model;

/**
 * Class Article
 *
 * @package Model
 */
class Payment extends Model
{
    public function getPaymentForUserAndShoppingCart(
        string $userId,
        string $shoppingCartId
    ): QueryResult {
        $userModel = new User();
        $shoppingCartModel = new ShoppingCart();

        $userQueryResult = $userModel->findById($userId);
        $shoppingCartQueryResult = $shoppingCartModel->getById($shoppingCartId);

        return new QueryResult(
            [self::mapToPayment($userQueryResult, $shoppingCartQueryResult)],
            null
        );
    }

    public static function mapToPayment(
        QueryResult $userQueryResult,
        QueryResult $shoppingCartQueryResult
    ): Domain\Payment {
        return new Domain\Payment(
            $userQueryResult->getResult(),
            $shoppingCartQueryResult->getResult()
        );
    }
}
