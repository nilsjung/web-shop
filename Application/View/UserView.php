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
        $this->template->firstName = $this->model->getFirstName();
        $this->template->lastName = $this->model->getLastName();
        $this->template->emailAddress = $this->model->getEmailAddress();
        $this->template->password = $this->model->getPassword();

        return $this->template->render("User.inc");
    }
}
