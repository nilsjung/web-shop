<?php

namespace View;

/**
 * Class LoginView
 *
 * @package View
 */
class LoginView extends View
{
    /**
     * sets the validation error flag if an error occurred during the login in process.
     */
    public function validationError(): void
    {
        $this->template->hasValidationError = true;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        if ($this->model->hasError()) {
            $this->validationError();
        }
        return $this->template->render("Login.inc");
    }
}
