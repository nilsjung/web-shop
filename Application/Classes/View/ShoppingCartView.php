<?php

namespace View;

use Controller\SessionController;

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
        $this->template->isAuthenticated = SessionController::isAuthenticated()
            ? "true"
            : "false";
        $this->template->articles = $this->model->getResult()->getArticles();
        return $this->template->render("ShoppingCart.inc");
    }
}
