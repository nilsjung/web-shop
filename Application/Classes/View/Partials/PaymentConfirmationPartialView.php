<?php

namespace View\Partials;

use Controller\SessionController;

/**
 * Class ArticleView
 *
 * @package View
 */
class PaymentConfirmationPartialView extends \View\View
{
    /**
     * @return mixed
     */
    public function render(): string
    {
        $this->template->user = $this->model->getResult()->getUser();
        $this->template->articles = $this->model
            ->getResult()
            ->getShoppingCart()
            ->getArticles();
        return $this->template->renderPartial(
            "Partials/Payment.Confirmation.inc"
        );
    }
}
