<?php

namespace Controller;

use MongoDB\Driver\Query;

/**
 * Class ArticleController
 *
 * @package Controller
 */
class ShoppingCartController extends Controller
{
    /**
     * @param string $id
     * @return \Model\QueryResult
     */
    public function getById(string $id): \Model\QueryResult
    {
        return $this->model->getById($id);
    }

    /**
     * @param string $shoppingCartId
     * @param $string
     * @return \Model\QueryResult
     */
    public function addArticle(
        string $shoppingCartId,
        string $articleId
    ): \Model\QueryResult {
        return $this->model->addArticle($shoppingCartId, $articleId);
    }

    public function insertShoppingCart(string $id)
    {
        return $this->model->save($id);
    }
}
