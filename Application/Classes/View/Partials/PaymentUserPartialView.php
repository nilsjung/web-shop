<?php

namespace View\Partials;

/**
 * Class ArticleView
 *
 * @package View
 */
class PaymentUserPartialView extends \View\View
{
    /**
     * @return mixed
     */
    public function render(): string
    {
        $this->template->user = $this->model->getResult()->getUser();
        return $this->template->renderPartial("Partials/Payment.User.inc");
    }
}
