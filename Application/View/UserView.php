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
     * UserView constructor.
     *
     * @param $controller
     * @param \Model\Domain\User $model
     */
    public function __construct($controller, \Model\Domain\User $model)
    {
        parent::__construct($controller, $model);
        $this->controller = $controller;
        $this->model = $model;
    }

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
