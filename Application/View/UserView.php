<?php

namespace View;

use Model\User;

class UserView extends View {

    /**
     * UserView constructor.
     *
     * @param $controller
     * @param User $model
     */
    public function __construct( $controller, User $model ) {
        parent::__construct($controller, $model);
        $this->controller = $controller;
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function render() {
        $this->template->firstName = $this->model->getFirstName();
        $this->template->lastName = $this->model->getLastName();
        $this->template->emailAddress = $this->model->getEmailAddress();
        return $this->template->render("User.inc");
    }
}