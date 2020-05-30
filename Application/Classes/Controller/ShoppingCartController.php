<?php

namespace Controller;

use Model\Article;
use Model\QueryResult;

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
        // test if stock is greater than the requested articles
        $articleModel = new Article();
        $article = $articleModel->getArticleById($articleId)->getResult();
        $shoppingCart = $this->getById($shoppingCartId)->getResult();
        $shoppingCart->addArticle($article);

        $articleStock = $article->getStock();
        $articles = $shoppingCart->getArticle($articleId);

        if (!is_null($articles) && $articleStock === $articles->getInCart()) {
            return new QueryResult(null, "Limit is reached");
        }

        return $this->model->addArticle($shoppingCartId, $articleId);
    }

    public function removeArticle(
        string $shoppingCartId,
        string $articleId
    ): \Model\QueryResult {
        // guarantee that article count is not lower than zero
        $articleModel = new Article();
        $shoppingCart = $this->getById($shoppingCartId)->getResult();
        $article = $shoppingCart->getArticle($articleId);

        if (!is_null($article) && $article->getInCart() <= 0) {
            return new QueryResult(null, "could not reduce any further");
        }

        return $this->model->removeArticle($shoppingCartId, $articleId);
    }

    public function deleteArticle(
        string $shoppingCartId,
        string $articleId
    ): \Model\QueryResult {
        return $this->model->deleteArticle($shoppingCartId, $articleId);
    }

    public function insertShoppingCart(string $id)
    {
        return $this->model->save($id);
    }
}
