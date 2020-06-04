<?php

namespace View;

use Controller\SessionController;
use Model\QueryResult;

/**
 * Class ArticleView
 *
 * @package View
 */
class PaymentView extends View
{
    /**
     * @return mixed
     */
    public function render(): string
    {
        $this->template->isAuthenticated = SessionController::isAuthenticated();
        $this->template->paymentStep = $this->template->paymentStep
            ? $this->template->paymentStep
            : 0;
        return $this->template->render("Payment.inc");
    }
}
