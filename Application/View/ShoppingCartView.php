<?php

namespace View;

/**
 * Class ArticleView
 *
 * @package View
 */
class ShoppingCartView extends View
{
    /**
     * @return mixed
     */
    public function render(): string
    {
        $this->template->articles = $this->model->getArticles();
        return $this->template->render("ShoppingCart.inc");
    }
}
