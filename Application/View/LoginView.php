<?php

namespace View;

/**
 * Class LoginView
 *
 * @package View
 */
class LoginView extends View {

    /**
     * LoginView constructor.
     *
     * @param $controller
     * @param $model
     */
    public function __construct( $controller, $model ) {
        parent::__construct($controller, $model);
        $this->template->hasValidationError = false;
    }

    /**
     * sets the validation error flag if an error occurred during the login in process.
     */
    public function validationError() : void {
        $this->template->hasValidationError = true;
    }

    /**
     * @return string
     */
    public function render() : string {
        return $this->template->render("Login.inc");
    }
}