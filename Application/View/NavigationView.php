<?php

namespace View;

use Controller\SessionController;

class NavigationView extends View {

    public function render() {
        if ( SessionController::isAuthenticated() ) {
            $this->template->isAuthenticated = true;
        } else {
            $this->template->isAuthenticated = false;
        }

        if (array_key_exists('REDIRECT_URL', $_SERVER)) {
            $this->template->activeRoute = $_SERVER['REDIRECT_URL'];
        } else {
            $this->template->activeRoute = '/';
        }

        return $this->template->render("Navigation.inc");

    }
}