<?php

namespace View;

/**
 * Class ArticleView
 *
 * @package View
 */
class ArticleView extends View
{
    /**
     * @return mixed
     */
    public function render()
    {
        $this->template->articles = $this->model;
        $this->template->title = "Articles";
        return $this->template->render("Articles.inc");
    }
}
