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
     * @param string $articleId
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

        $articleStock = $article->getStock();
        $articles = $shoppingCart->getArticle($articleId);

        if (!is_null($articles) && $articles->getInCart() > $articleStock) {
            return new QueryResult(null, "Limit is reached");
        }

        $shoppingCart->addArticle($article);
        return $this->model->addArticle($shoppingCartId, $articleId);
    }

    /**
     * @param string $shoppingCartId
     * @param string $articleId
     * @return QueryResult
     */
    public function removeArticle(
        string $shoppingCartId,
        string $articleId
    ): \Model\QueryResult {
        // guarantee that article count is not lower than zero
        $shoppingCart = $this->getById($shoppingCartId)->getResult();
        $article = $shoppingCart->getArticle($articleId);

        if (!is_null($article) && $article->getInCart() <= 0) {
            return new QueryResult(null, "could not reduce any further");
        }

        return $this->model->removeArticle($shoppingCartId, $articleId);
    }

    /**
     * @param string $shoppingCartId
     * @param string $articleId
     * @return QueryResult
     */
    public function deleteArticle(
        string $shoppingCartId,
        string $articleId
    ): \Model\QueryResult {
        return $this->model->deleteArticle($shoppingCartId, $articleId);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function insertShoppingCart(string $id)
    {
        return $this->model->save($id);
    }
}
