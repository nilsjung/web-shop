<?php

namespace Controller;

/**
 * Class ArticleController
 *
 * @package Controller
 */
class ShoppingCartController extends Controller
{
    /**
     * @param string $id
     * @return \Model\Domain\ShoppingCart|null
     */
    public function getById(string $id)
    {
        return $this->model->getById($id);
    }

    /**
     * @param string $shoppingCartId
     * @param $string
     */
    public function addArticle(
        string $shoppingCartId,
        string $articleId
    ): \Model\Domain\ShoppingCart {
        return $this->model->addArticle($shoppingCartId, $articleId);
    }

    public function insertShoppingCart(string $id)
    {
        return $this->model->save($id);
    }
}
