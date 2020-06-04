<?php

namespace View;

/**
 * Class UserView
 *
 * @package View
 */
class UserView extends View
{
    /**
     * @return string
     */
    public function render(): string
    {
        $this->template->firstName = $this->model->getResult()->getFirstName();
        $this->template->lastName = $this->model->getResult()->getLastName();
        $this->template->paymentMethod = $this->model
            ->getResult()
            ->getPaymentMethod();
        $this->template->emailAddress = $this->model
            ->getResult()
            ->getEmailAddress();
        $this->template->password = $this->model->getResult()->getPassword();

        return $this->template->render("User.inc");
    }
}
