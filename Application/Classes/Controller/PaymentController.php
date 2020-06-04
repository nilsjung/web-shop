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
    /**
     * PaymentController constructor.
     *
     * @param \Model\Payment $model
     */
    public function __construct(\Model\Payment $model)
    {
        parent::__construct($model);
    }

    public function getPayment(
        ?string $userId,
        ?string $shoppingCartId
    ): QueryResult {
        if (is_null($shoppingCartId) || is_null($userId)) {
            die("should not be null");
        }

        return $this->model->getPaymentForUserAndShoppingCart(
            $userId,
            $shoppingCartId
        );
    }
}
