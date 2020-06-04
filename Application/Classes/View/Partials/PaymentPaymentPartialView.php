<?php

namespace View\Partials;

use Controller\SessionController;

/**
 * Class ArticleView
 *
 * @package View
 */
class PaymentPaymentPartialView extends \View\View
{
    /**
     * @return mixed
     */
    public function render(): string
    {
        $this->template->articles = $this->model
            ->getResult()
            ->getShoppingCart()
            ->getArticles();
        $this->template->paymentMethod = $this->model
            ->getResult()
            ->getUser()
            ->getPaymentMethod();
        return $this->template->renderPartial("Partials/Payment.Payment.inc");
    }
}
