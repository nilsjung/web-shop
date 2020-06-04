<?php

namespace Controller;

use Model\Article;
use Model\QueryResult;
use Model\ShoppingCart;

class OrderController extends Controller
{
    public function createOrder(
        float $total,
        string $userId,
        string $shoppingCartId
    ): QueryResult {
        $articleController = new ArticleController(new Article());
        $shoppingCartController = new ShoppingCartController(
            new ShoppingCart()
        );

        $shoppingCart = $shoppingCartController
            ->getById($shoppingCartId)
            ->getResult();

        $result = $this->model->createOrder($total, $userId);
        if (is_null($result->getResult())) {
            return $result;
        }
        $articleController->reduceStock($shoppingCart->getArticles());
        return $result;
    }

    public function getOrderById(string $orderId): QueryResult
    {
        return $this->model->getById($orderId);
    }
}
