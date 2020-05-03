<?php

namespace View;

class LoginView extends View {

    /**
     * @return mixed
     */
    public function render() {
        return $this->template->render("Login.inc");
    }
}