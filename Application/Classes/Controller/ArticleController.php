<?php

namespace Controller;

/**
 * Class ArticleController
 *
 * @package Controller
 */
class ArticleController extends Controller
{
    /**
     *
     */
    public function getAllArticles(): \Model\QueryResult
    {
        return $this->model->getAll();
    }

    /**
     * @param string $article_id
     * @return \Model\QueryResult
     */
    public function getArticleById(string $article_id): \Model\QueryResult
    {
        return $this->model->getArticleById($article_id);
    }
}
