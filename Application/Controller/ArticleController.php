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
    public function getAllArticles(): iterable
    {
        return $this->model->getAll();
    }

    /**
     * @param string $article_id
     * @return \Model\Domain\Article
     */
    public function getArticleById(string $article_id): \Model\Domain\Article
    {
        return $this->model->getArticleById($article_id);
    }
}
