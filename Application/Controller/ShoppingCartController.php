<?php

namespace Controller;

use Model\ShoppingCart;

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
        $data = new \Model\ShoppingCart();
        $this->model = $data->getById($id);
        return $this->model;
    }

    /**
     * @param \Model\Domain\Article $article
     * @return \Model\Domain\ShoppingCart
     */
    public function addArticle(
        \Model\Domain\Article $article
    ): \Model\Domain\ShoppingCart {
        $this->model->addArticle($article);
        $this->model->update($this->model);
        return $this->model;
    }
}
