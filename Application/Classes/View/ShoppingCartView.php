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
        $this->template->paymentStep = SessionController::isAuthenticated()
            ? 1
            : 0;
        $this->template->articles = $this->model->getResult()->getArticles();
        $this->template->shoppingCartTotal = $this->model
            ->getResult()
            ->getSum();
        return $this->template->render("ShoppingCart.inc");
    }
}
