<?php

namespace View\Partials;

/**
 * Class ArticleView
 *
 * @package View
 */
class PaymentLoginPartialView extends \View\View
{
    /**
     * @return mixed
     */
    public function render(): string
    {
        return $this->template->renderPartial("Partials/Payment.Login.inc");
    }
}
