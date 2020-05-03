<?php

namespace View;

class LoginView extends View {

    public function __construct( $controller, $model ) {
        parent::__construct($controller, $model);
        $this->template->hasValidationError = false;
    }

    public function validationError() {
        $this->template->hasValidationError = true;
    }

    /**
     * @return mixed
     */
    public function render() {
        return $this->template->render("Login.inc");
    }
}