<?php

namespace Controller;

/**
 * Class ArticleController
 *
 * @package Controller
 */
class ShoppingCartController extends Controller
{
    public function getById(string $id)
    {
        $data = new \Model\ShoppingCart();
        $this->model = $data->getById($id);
        return $this->model;
    }
}
