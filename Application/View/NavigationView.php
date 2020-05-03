<?php

namespace View;

use Controller\SessionController;

/**
 * Class NavigationView
 *
 * @package View
 */
class NavigationView extends View {

    /**
     * @return string
     */
    public function render(): string {

        /** check if the current session is authenticated */
        if ( SessionController::isAuthenticated() ) {
            $this->template->isAuthenticated = true;
        } else {
            $this->template->isAuthenticated = false;
        }

        /** this is used to set the `active` class for the navigation links */
        if ( array_key_exists('REDIRECT_URL', $_SERVER) ) {
            $this->template->activeRoute = $_SERVER[ 'REDIRECT_URL' ];
        } else {
            $this->template->activeRoute = '/';
        }

        return $this->template->render("Navigation.inc");

    }
}