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
        $this->template->hash = $this->model->getResult()->getPaymentHash();
        $this->template->user = $this->model->getResult()->getUser();
        $this->template->shoppingCart = $this->model
            ->getResult()
            ->getShoppingCart();
        return $this->template->renderPartial(
            "Partials/Payment.Confirmation.inc"
        );
    }
}
